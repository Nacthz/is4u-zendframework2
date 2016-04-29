<?php
namespace Cart\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Product\Model\Product;
use Product\Form\ProductForm;
use Zend\View\Model\JsonModel;


class CartController extends AbstractActionController
{
    public function indexAction()
    {
        return array(
            'items' => $this->ZendCart()->cart(),
            'total_items' => $this->ZendCart()->total_items(),
            'total' => $this->ZendCart()->total(),
        );
    }
}