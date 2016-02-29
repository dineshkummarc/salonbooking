<?php


final class SLN_Wrapper_Booking_Service {
	private $data;

	/**
	 * SLN_Wrapper_Booking_Service constructor.
	 *
	 * @param $data
	 */
	public function __construct( $data ) {
		$this->data = array(
			'service'   => SLN_Plugin::getInstance()->createService($data['service']),
			'attendant' => SLN_Plugin::getInstance()->createAttendant($data['attendant']),
			'starts_at'  => new SLN_DateTime(SLN_Func::filter($data['starts_date'], 'date') . ' ' . SLN_Func::filter($data['starts_time'], 'time')),
			'duration'  => new SLN_DateTime('1970-01-01 ' . SLN_Func::filter($data['duration'], 'time')),
			'price'     => $data['price'],
			'exec_order' => $data['exec_order'],
		);
	}

	/**
	 * @return SLN_DateTime
	 */
	public function getDuration() {
		return $this->data['duration'];
	}

	/**
	 * @return array
	 */
	public function toArray() {
		return array(
			'attendant'   => $this->data['attendant']->getId(),
			'service'     => $this->data['service']->getId(),
			'duration'    => $this->data['duration']->format('H:i'),
			'starts_date' => $this->data['starts_at']->format('Y-m-d'),
			'starts_time' => $this->data['starts_at']->format('H:i'),
			'price'       => floatval($this->data['price']),
			'exec_order'  => intval($this->data['exec_order']),
		);
	}

	public function __toString(){
		/** @var SLN_Wrapper_Service $service */
		$service = $this->data['service'];
		return $service->__toString();
	}
}