<?php
	class gw_oxid_precalculate_delivery_costs_oxviewconfig extends gw_oxid_precalculate_delivery_costs_oxviewconfig_parent {

		/**
		 * check in tpl if this module is active
		 * [{if $oViewConf->has_function_gw_calculate_delivery_cost}]...[{/if}]
		 * @var bool
		 */
		public $has_function_gw_calculate_delivery_cost = true;

		/**
		 * Calculates delivery costs for a specific shipping set
		 * @see oxbasket _calcDeliveryCost()
		 * @param $sShipSetId
		 * @return mixed
		 */
		public function gw_calculate_delivery_cost($sShipSetId) {
			$myConfig = $this->getConfig();
			$oDeliveryPrice = oxNew('oxprice');
			$oBasket = oxRegistry::getSession()->getBasket();

			if ($this->getConfig()->getConfigParam('blDeliveryVatOnTop')) {
				$oDeliveryPrice->setNettoPriceMode();
			} else {
				$oDeliveryPrice->setBruttoPriceMode();
			}

			// don't calculate if not logged in
			$oUser = $oBasket->getBasketUser();
			//$current_sShipSetId = $oBasket->getShippingId();

			if (!$oUser && !$myConfig->getConfigParam('blCalculateDelCostIfNotLoggedIn')) {
				return $oDeliveryPrice;
			}

			$fDelVATPercent = $oBasket->getAdditionalServicesVatPercent();
			$oDeliveryPrice->setVat($fDelVATPercent);

			// list of active delivery costs
			if ($myConfig->getConfigParam('bl_perfLoadDelivery')) {
				$oDeliveryList = oxNew("oxDeliveryList");
				$aDeliveryList = array();
				$oDelSetList = oxNew("oxDeliverySetList");
				$aDelSetList = $oDelSetList->getDeliverySetList($oUser, $oBasket->_findDelivCountry(), $sShipSetId);

				// ids of deliveries that does not fit for us to skip double check
				$aSkipDeliveries = array();

				// must choose right delivery set to use its delivery list
				foreach ($aDelSetList as $sDeliverySetId => $oDeliverySet) {

					// loading delivery list to check if some of them fits
					$aDeliveries = $oDeliveryList->_getList($oUser, $oBasket->_findDelivCountry(), $sShipSetId);

					foreach ($aDeliveries as $sDeliveryId => $oDelivery) {

						// skipping that was checked and didn't fit before
						if (in_array($sDeliveryId, $aSkipDeliveries)) {
							continue;
						}

						$aSkipDeliveries[] = $sDeliveryId;

						if ($oDelivery->isForBasket($oBasket)) {

							// delivery fits conditions
							$aDeliveryList[$sDeliveryId] = $aDeliveries[$sDeliveryId];

							// removing from unfitting list
							array_pop($aSkipDeliveries);

							// maybe checked "Stop processing after first match" ?
							if ($oDelivery->oxdelivery__oxfinalize->value) {
								break;
							}
						}
					}
				}

				// calculate shipping costs
				if (count($aDeliveryList) > 0) {
					foreach ($aDeliveryList as $oDelivery) {
						//debug trace
						if ($myConfig->getConfigParam('iDebug') == 5) {
							echo("DelCost : " . $oDelivery->oxdelivery__oxtitle->value . "<br>");
						}
						if($oDelivery->isForBasket($oBasket)) {
							$oDeliveryPrice->addPrice($oDelivery->getDeliveryPrice($fDelVATPercent));
						}
					}
				}
			}

			return $oDeliveryPrice;
		}
	}
?>