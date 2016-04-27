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


class PaymentsController extends AbstractActionController
{


   

    /** Get Access Token Valut API **/
     function _getAccessKey($clientId, $clientSecret) {
        $accessToken = '';
        $url = "https://api.sandbox.paypal.com/v1/oauth2/token";
        try {

            $config = array(
                'adapter' => 'Zend_Http_Client_Adapter_Curl',
                'curloptions' => array(
                    CURLOPT_FOLLOWLOCATION => TRUE,
                    CURLOPT_SSL_VERIFYPEER => FALSE,
                    CURLOPT_USERPWD => "{$clientId}:{$clientSecret}"
                ),
            );
            $client = new Zend_Http_Client($url, $config);
            $postArray = array('grant_type' => 'client_credentials');
            $client->setParameterPost($postArray);

            $response = $client->request('POST');
            $response = json_decode($response->getBody());
            $accessToken = $response->access_token;
        } catch (Exception $e) {
            $e->getMessage();
            die;
        }
        return $accessToken;
    }


    function _storedCCDetails($clientId, $clientSecret,$accessToken,$creditCardDtls){
        $url = "https://api.sandbox.paypal.com/v1/vault/credit-cards";
        $config = array(
            'adapter' => 'Zend_Http_Client_Adapter_Curl',
            'curloptions' => array(
                CURLOPT_FOLLOWLOCATION => TRUE,
                CURLOPT_SSL_VERIFYPEER => FALSE,
                CURLOPT_USERPWD => "{$clientId}:{$clientSecret}"
            ),
        );
        $client = new Zend_Http_Client($url, $config);
        
        
        $client->setHeaders('Content-Type', 'application/json');
        $client->setHeaders('Authorization', "Bearer $accessToken");
        $response = $client->setRawData(json_encode($creditCardDtls), 'application/json')->request('POST');
        $data = json_decode($response->getBody());
        return $data;
    }

    function storecreditcardAction(){
        /** Get Access Token **/
        $accessToken = $this->_getAccessKey($this->clientId, $this->secretKey);
        /** Get Access Token **/

        //store credit card details
        $creditCardDtls = array(
        "payer_id" => "user1234567",
        "type" => "visa",
        "number" => "4417119669820331",
        "expire_month" => "11",
        "expire_year" => "2018",
        "first_name" => "Betsy",
        "last_name" => "Buyer",
        "billing_address" => array(
            "line1" => "111 First Street",
            "city" => "Mohali",
            "country_code" => "IN",
            "state" => "punjab",
            "postal_code" => "4252"
        )
        );

        $details = $this->_storedCCDetails($this->clientId, $this->secretKey,$accessToken, $creditCardDtls);

        //This is payer Account ID
        echo $payerId = $details->payer_id; echo '\n';
        //this is credit card Id used for pyament
        echo $creditCardId= $details->id;die;
    }


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

        $paypalRequest      =   $this->getServiceLocator()->get('SpeckPaypal\Service\Request');
        $response           =   $paypalRequest->send($transactionSearch);

        return new ViewModel([
            'transactions'  =>  $response->getResults()
        ]);
    }

    /**
     * Create
     * Create a new PayPal Payment
     *
     * @return \Zend\Http\Response
     */
    public function createAction()
    {
        $_clientId='AfsmLtbIBk2XSKJAU86MCSGkm51hoMVvZZCPWgLW3AnFh7tLTNQaq0f4r6bzOKVZZsh2oePJZfdC6wRh';
       $_secretKey='ENgr_8rRPbAyP38r7xC_l4jPlYbWF7mc-wzykgc5AVvAcRE88Y_Kr34DCJ0WX-8K0mn7bQBGVLZmZUAJ'; 
         $accessToken = '';
        $url = "https://api.sandbox.paypal.com/v1/oauth2/token";
        try {

            $config = array(
                'adapter' => 'Zend_Http_Client_Adapter_Curl',
                'curloptions' => array(
                    CURLOPT_FOLLOWLOCATION => TRUE,
                    CURLOPT_SSL_VERIFYPEER => FALSE,
                    CURLOPT_USERPWD => "{$_clientId}:{$_secretKey}"
                ),
            );
            $client = new Zend_Http_Client($url, $config);
            $postArray = array('grant_type' => 'client_credentials');
            $client->setParameterPost($postArray);

            $response = $client->request('POST');
            $response = json_decode($response->getBody());
            $accessToken = $response->access_token;
        } catch (Exception $e) {
            $e->getMessage();
            die;
        }
        echo $accessToken;
//         _getAccessKey($_clientId, $_secretKey);

/*        // PayPal Request
        $paypalRequest = $this->getServiceLocator()->get('SpeckPaypal\Service\Request');

        // Paypal PaymentItem
        $item = new \Payments\Model\PaymentsModel();
        $item = $item->findById(1);

        // Set the PaymentDetails (MaxCost of all Items)
        $paymentDetails = new \SpeckPaypal\Element\PaymentDetails([
            'amt' => $item->getAmt()
        ]);

        // Set the items
        $paymentDetails->setItems([ $item ]);

        // Create a new ExpressCheckOut
        $express = new \SpeckPaypal\Request\SetExpressCheckout(['paymentDetails' => $paymentDetails]);
        $express->setReturnUrl($this->url()->fromRoute('payments-finish', [], ['force_canonical' => true]));
        $express->setCancelUrl($this->url()->fromRoute('payments-failure', [], ['force_canonical' => true]));

        // Do a request
        $response = $paypalRequest->send($express);

        // Check if we are using a sandbox
        $host = ( strpos($paypalRequest->getConfig()->getEndPoint(), 'sandbox') !== false ) ? 'sandbox.paypal' : 'paypal';

        // Redirect to Paypal!
        */

  //      return $this->redirect()->toUrl(sprintf('https://www.%s.com/cgi-bin/webscr?cmd=_express-checkout&token=%s', $host, $response->getToken()));
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
        $paypalRequest = $this->getServiceLocator()->get('SpeckPaypal\Service\Request');

        // GetExpressCheckoutDetails
        $details = new \SpeckPaypal\Request\GetExpressCheckoutDetails(array(
            'token' => $this->params()->fromQuery('token')
        ));

        // Do a request
        $response = $paypalRequest->send($details);

        // Paypal PaymentItem
        $item = new \Payments\Model\PaymentsModel();
        $item = $item->findById(1);

        // Set the PaymentDetails (MaxCost of all Items)
        $paymentDetails = new \SpeckPaypal\Element\PaymentDetails([
            'amt' => $item->getAmt()
        ]);

        // Set the items
        $paymentDetails->setItems([ $item ]);

        // DoExpressCheckoutPayment
        $captureExpress = new \SpeckPaypal\Request\DoExpressCheckoutPayment([
            'token'             => $this->params()->fromQuery('token'),
            'payerId'           => $response->getPayerId(),
            'paymentDetails'    => $paymentDetails
        ]);

        $response = $paypalRequest->send($captureExpress);

        return new ViewModel([
            'transaction'   =>  $response
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

        $paypalRequest      =   $this->getServiceLocator()->get('SpeckPaypal\Service\Request');
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
