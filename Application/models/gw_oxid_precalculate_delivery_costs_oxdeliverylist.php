<?php
	class gw_oxid_precalculate_delivery_costs_oxdeliverylist extends gw_oxid_precalculate_delivery_costs_oxdeliverylist_parent {
		/**
		 * make this function public
		 */
		public function _getList($oUser = null, $sCountryId = null, $sDelSet = null) {
			return parent::_getList($oUser, $sCountryId, $sDelSet);
		}
	}
?>