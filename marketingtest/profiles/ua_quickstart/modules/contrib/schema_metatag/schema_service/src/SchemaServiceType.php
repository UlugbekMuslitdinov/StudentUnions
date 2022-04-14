<?php

/**
 * Provides a plugin for the '@type' meta tag.
 */
class SchemaServiceType extends SchemaTypeBase {

  /**
   * {@inheritdoc}
   */
  public static function labels() {
    return [
      'Service',
      'BroadcastService',
      'CableOrSatelliteService',
      'FinancialProduct',
      '- BankAccount',
      '-- DepositAccount',
      '- CurrencyConversionService',
      '- InvestmentOrDeposit',
      '-- DepositAccount',
      '- LoanOrCredit',
      '-- CreditCard',
      '- PaymentCard',
      '- PaymentService',
      'FoodService',
      'GovernmentService',
      'TaxiService',
    ];
  }

}
