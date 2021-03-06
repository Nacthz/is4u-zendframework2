<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Payments\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
    
use Zend\Session\Validator\HttpUserAgent;
use Zend\Session\SessionManager;

class PaymentsController extends AbstractActionController
{
    /**
     * Index
     * Overview of all the payments
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        // TransactionSearch
        $transactionSearch  =   new \SpeckPaypal\Request\TransactionSearch();
        $transactionSearch->setStartDate('2014-12-28T00:00:00Z');
        $paypalRequest = $this->getPaypalRequest();
        //$paypalRequest      =   $this->getServiceLocator()->get('SpeckPaypal\Service\Request');
        $response           =   $paypalRequest->send($transactionSearch);

        return new ViewModel([
            'transactions'  =>  $response->getResults()
        ]);
    }




    protected function getPaypalRequest()
    {
        $config = $this->getServiceLocator()->get('config');
        $paypalConfig = new \SpeckPaypal\Element\Config(
        $config['speck-paypal-api']);
        $adapter = new \Zend\Http\Client\Adapter\Curl();
        $adapter->setOptions(array(
            'curloptions' => array(
                CURLOPT_SSL_VERIFYPEER => false,
                )
            ));
        $client = new \Zend\Http\Client;
        $client->setMethod('POST');
        $client->setAdapter($adapter);
        $paypalRequest = new \SpeckPaypal\Service\Request;
        $paypalRequest->setClient($client);
        $paypalRequest->setConfig($paypalConfig);
        return $paypalRequest;
    }



public function currency($from_Currency,$to_Currency,$amount) {
  
    return round($var,2);
}
    /**
     * Create
     * Create a new PayPal Payment
     *
     * @return \Zend\Http\Response
     */
    public function createAction()
    {


    $request = $this->getRequest();
    

    $orderId = $request->getPost()->get('orderId');

        
    $total_a_PAGAR=str_replace(",","", $this->params()->fromQuery('total_pagar'));


  $amount = urlencode($total_a_PAGAR);
  $from_Currency = urlencode('COP');
  $to_Currency = urlencode('USD');
  $get = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency");
  $get = explode("<span class=bld>",$get);
  $get = explode("</span>",$get[1]);  
  $converted_amount = preg_replace("/[^0-9\.]/", null, $get[0]);
  $converted_amount=round($converted_amount,2);
    //echo $converted_amount ;


    $orderTable = new \Payments\Model\PaymentsModel();
    $order = $orderTable->findById(1);
    $order->setAmt($converted_amount);
    $paypalRequest = $this->getPaypalRequest();
    $paymentDetails = new \SpeckPaypal\Element\PaymentDetails(array(
        'amt' => $order->getAmt()
    ));

    //echo $order->getAmt();
    // Set the items
    $paymentDetails->setItems([ $order ]);

    $express = new \SpeckPaypal\Request\SetExpressCheckout(
        array('paymentDetails' => $paymentDetails)
    );
    $express->setReturnUrl($this->url()->fromRoute('payments-finish', [], ['force_canonical' => true]));
    $express->setCancelUrl($this->url()->fromRoute('payments-failure', [], ['force_canonical' => true]));
    // Send Order information to PayPal
    $response = $paypalRequest->send($express);
    $token = $response->getToken();


    $this->redirect()->toUrl('https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=' . $token);
    }

    /**
     * Finish
     * Finish after the payment
     *
     * @return ViewModel
     */
    public function finishAction()
    {



        // PayPal Request
        $paypalRequest = $this->getPaypalRequest();

        // GetExpressCheckoutDetails
        $expressCheckoutInfo = new \SpeckPaypal\Request\GetExpressCheckoutDetails(array(
            'token' => $this->params()->fromQuery('token')
        ));
        $response = $paypalRequest->send($expressCheckoutInfo);


        //To capture express payment
        $orderTable = new \Payments\Model\PaymentsModel();
        $order = $orderTable->findById(1);
        $paymentDetails = new \SpeckPaypal\Element\PaymentDetails(array(
            'amt' => $order->getAmt()
        ));

        // Set the items
        $paymentDetails->setItems([ $order ]);

        $token = $response->getToken();
        $payerId = $response->getPayerId();
        $captureExpress = new \SpeckPaypal\Request\DoExpressCheckoutPayment(array(
            'token' => $token,
            'payerId' => $payerId,
            'paymentDetails' => $paymentDetails
        ));
        $confirmPaymentResponse = $paypalRequest->send($captureExpress);
        


        //To Save Order Information
        $order->first_name = $response->getFirstName();
        $order->last_name = $response->getLastName();
        $order->ship_to_street = $response->getShipToStreet();


        $order->ship_to_city = $response->getShipToCity();
        $order->ship_to_state = $response->getShipToState();
        $order->ship_to_zip = $response->getShipToZip();
        $order->email = $response->getEmail();
        $order->store_order_id = 293;
        $order->status = 'completed';


        return new ViewModel([
            'transaction'   =>  $confirmPaymentResponse
        ]);
    }

    /**
     * Failure
     * @return ViewModel
     */
    public function failureAction()
    {
        return new ViewModel([]);
    }

    /**
     * Read
     * @return void|ViewModel
     */
    public function readAction()
    {
        // TransactionSearch
        $transactionSearch  =   new \SpeckPaypal\Request\TransactionSearch();
        $transactionSearch->setTransactionId($this->params()->fromRoute('id'));
        $transactionSearch->setStartDate('2014-12-28T00:00:00Z');

        $paypalRequest = $this->getPaypalRequest();
        $response           =   $paypalRequest->send($transactionSearch);

        // We can't find the transaction
        if( !($response->getResults()[0]) ) { $this->getResponse()->setStatusCode(404); return; }

        return new ViewModel([
            'transaction'   =>  $response->getResults()[0]
        ]);
    }

    public function updateAction() {}
    public function deleteAction() {}
}
