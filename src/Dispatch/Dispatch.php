<?php

namespace Parcel\Chain\Dispatch;

use Parcel\Chain\DispatchBase;

class Dispatch extends DispatchBase {

	public function Initialize(array $Input = []) {
		$this->_RecentData = $Input;
	}
}