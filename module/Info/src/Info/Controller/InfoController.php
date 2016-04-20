<?php
namespace Info\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Product\Model\Product;
use Product\Form\ProductForm;
use Zend\View\Model\JsonModel;

class InfoController extends AbstractActionController
{
	protected $productTable;

    public function indexAction()
    {
        return array(
            'products' => $this->getProductTable()->fetchAll(),
            'items' => $this->ZendCart()->cart(),
            'total_items' => $this->ZendCart()->total_items(),
            'total' => $this->ZendCart()->total(),
        );
    }

    public function additemAction()
    {
        $id = $_POST['id'];
        try {
            $product = $this->getProductTable()->getProduct($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('product');
        }

        $product = array(
            'id'      => $product->id,
            'qty'     => 1,
            'price'   => $product->price_sale,
            'name'    => $product->name,
            'options' => array('img' => $product->photo)
        );
        $this->ZendCart()->insert($product);

        $result = new JsonModel(array(
        'status' => 'Agregado',
            'success'=>true,
        ));

        return $result;
    }

    public function cartAction()
    {
        return array(
            'products' => $this->getProductTable()->fetchAll(),
            'items' => $this->ZendCart()->cart(),
            'total_items' => $this->ZendCart()->total_items(),
            'total' => $this->ZendCart()->total(),
        );
    }

    public function faqAction()
    {
        return new ViewModel();
    }

    public function getProductTable()
    {
        if (!$this->productTable) {
            $sm = $this->getServiceLocator();
            $this->productTable = $sm->get('Product\Model\ProductTable');
        }
        return $this->productTable;
    }
}