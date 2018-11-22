# Pre calculate delivery costs

When users have to choose a delivery method normally they want to know how much it is. In OXID eShop the calculation of delivery costs before a delivery method is chosen isn't standard behavior.
This module gives you a function oxviewconfig::gw_calculate_delivery_cost($sShipSetId) that can do that for you.

## Install
- This module has to be put to the folder
\[shop root\]**/modules/gw/gw_oxid_precalculate_delivery_costs/**

- You also have to create a file
\[shop root\]/modules/gw/**vendormetadata.php**

After you have done that go to shop backend and activate module.
    