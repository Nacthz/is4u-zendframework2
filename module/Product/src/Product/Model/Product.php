<?php
namespace Product\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class Product implements InputFilterAwareInterface
{
	public $id;
	public $name;
	public $photo;
	public $detail;
	public $price;
	public $price_sale;
	public $quantity;
	protected $inputFilter;

	public function exchangeArray($data)
	{
		$this->id     = (!empty($data['id'])) ? $data['id'] : null;
		$this->name = (!empty($data['name'])) ? $data['name'] : null;
		$this->photo  = (!empty($data['photo'])) ? $data['photo'] : null;
		$this->detail  = (!empty($data['detail'])) ? $data['detail'] : null;
		$this->price  = (!empty($data['price'])) ? $data['price'] : null;
		$this->price_sale  = (!empty($data['price_sale'])) ? $data['price_sale'] : null;
		$this->quantity  = (!empty($data['quantity'])) ? $data['quantity'] : null;
	}

	public function getArrayCopy()
	{
		return get_object_vars($this);
	}

	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}

	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();

			$inputFilter->add(array(
				'name'     => 'id',
				'required' => true,
				'filters'  => array(
					array('name' => 'Int'),
				),
			));

			$inputFilter->add(array(
				'name'     => 'name',
				'required' => true,
				'filters'  => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 100,
						),
					),
				),
			));

			$inputFilter->add(array(
				'name'     => 'photo',
				'required' => true,
				'filters'  => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 150,
						),
					),
				),
			));

			$inputFilter->add(array(
				'name'     => 'detail',
				'required' => true,
				'filters'  => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 6000,
						),
					),
				),
			));

			$inputFilter->add(array(
				'name'     => 'price',
				'required' => true,
				'filters'  => array(
					array('name' => 'Int'),
				),
			));

			$inputFilter->add(array(
				'name'     => 'price_sale',
				'required' => true,
				'filters'  => array(
					array('name' => 'Int'),
				),
			));

			$inputFilter->add(array(
				'name'     => 'quantity',
				'required' => true,
				'filters'  => array(
					array('name' => 'Int'),
				),
			));
			$this->inputFilter = $inputFilter;
		}
		return $this->inputFilter;
	}
}