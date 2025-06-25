<?php

require_once 'primaryexportdisable.civix.php';
// phpcs:disable
use CRM_Primaryexportdisable_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function primaryexportdisable_civicrm_config(&$config) {
  _primaryexportdisable_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function primaryexportdisable_civicrm_install() {
  _primaryexportdisable_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function primaryexportdisable_civicrm_enable() {
  _primaryexportdisable_civix_civicrm_enable();
}

function primaryexportdisable_civicrm_buildForm($formName, $form) {
  if ($form instanceof CRM_Export_Form_Select) {
    $form->setDefaults(['exportOption' => CRM_Export_Form_Select::EXPORT_SELECTED]);
    $exportOptionElements = $form->getElement('exportOption')->getElements();
    foreach ($exportOptionElements as $exportOption) {
      if ($exportOption->getValue() == CRM_Export_Form_Select::EXPORT_ALL) {
        $exportOption->setAttribute('disabled');
        $exportOption->setText(E::ts('%1', [1 => Civi::settings()->get('primary_export_disable_message')]));
      }
    }
  }
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function primaryexportdisable_civicrm_preProcess($formName, &$form) {
//
//}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
function primaryexportdisable_civicrm_navigationMenu(&$menu) {
  _primaryexportdisable_civix_insert_navigation_menu($menu, 'Administer/Customize Data and Screens', [
    'label' => E::ts('Primary Export Disable Extension Settings'),
    'name' => 'primary_export_disable_settings',
    'url' => 'civicrm/admin/setting/primaryexportdisable',
    'permission' => 'administer CiviCRM',
    'operator' => 'OR',
    'separator' => 0,
  ]);
  _primaryexportdisable_civix_navigationMenu($menu);
}
