<?php
namespace Product\Form;

use Zend\Form\Form;

class ProductForm extends Form
{
	public function __construct($name = null)
	{
        // we want to ignore the name passed
		parent::__construct('product');

		$this->add(array(
			'name' => 'id',
			'type' => 'Hidden',
		));
		$this->add(array(
			'name' => 'name',
			'type' => 'Text',
			'options' => array(
				'label' => 'Nombre',
			),
		));
		$this->add(array(
			'name' => 'photo',
			'type' => 'Text',
			'options' => array(
				'label' => 'Foto',
			),
		));
		$this->add(array(
			'name' => 'detail',
			'type' => 'Text',
			'options' => array(
				'label' => 'Detalles',
			),
		));
		$this->add(array(
			'name' => 'price',
			'type' => 'Number',
			'options' => array(
				'label' => 'Precio',
			),
		));
		$this->add(array(
			'name' => 'price_sale',
			'type' => 'Number',
			'options' => array(
				'label' => 'Precio de venta',
			),
		));
		$this->add(array(
			'name' => 'quantity',
			'type' => 'Number',
			'options' => array(
				'label' => 'Cantidad',
			),
		));
		$this->add(array(
			'name' => 'submit',
			'type' => 'Submit',
			'attributes' => array(
				'value' => 'Go',
				'id' => 'submitbutton',
				),
		));
		$this->add(array(
			'name' => 'accept',
			'type' => 'Submit',
			'attributes' => array(
				'value' => 'Yes',
				'id' => 'submitbutton',
				),
		));
		$this->add(array(
			'name' => 'cancel',
			'type' => 'Submit',
			'attributes' => array(
				'value' => 'No',
				'id' => 'submitbutton',
				),
		));
	}
}