<?php
namespace Admin\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Product\Model\Product;
use Product\Form\ProductForm;
use Zend\View\Model\JsonModel;

class AdminController extends AbstractActionController
{
    protected $productTable;

    public function indexAction()
    {
        return array();
    }
    public function productAction()
    {
        return array(
            'products' => $this->getProductTable()->fetchAll(),
        );
    }

    public function producteditAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('admin', array('action' => 'product')); 
        }
        
        try {
            $product = $this->getProductTable()->getProduct($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('admin', array('action' => 'product')); 
        }

        $form  = new ProductForm();
        $form->bind($product); // formulario salga con la informacion del producto
        $form->get('submit')->setAttribute('value', 'Editar');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($product->getInputFilter()); //traer información del producto
            $form->setData($request->getPost()); // guardar información en la variable form

            if ($form->isValid()) {
                $this->getProductTable()->saveProduct($product); //se almacena en la base de datos 

                return $this->redirect()->toRoute('admin', array('action' => 'product')); //se redirige 
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function productdeleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('admin', array('action' => 'product')); 
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('option');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getProductTable()->deleteProduct($id);
            }

            return $this->redirect()->toRoute('admin', array('action' => 'product')); 
        }

        return array(
            'id'    => $id,
            'product' => $this->getProductTable()->getProduct($id)
        );
    }

    public function productaddAction()
    {
        $form = new ProductForm();
        $form->get('submit')->setValue('Agregar');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $product = new Product();
            $form->setInputFilter($product->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $product->exchangeArray($form->getData());
                $this->getProductTable()->saveProduct($product);

                return $this->redirect()->toRoute('admin', array('action' => 'product')); 
            }
        }
        return array('form' => $form);
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