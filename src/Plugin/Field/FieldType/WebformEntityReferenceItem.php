<?php

namespace Drupal\webform\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Field\Plugin\Field\FieldType\EntityReferenceItem;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Defines the 'webform_entity_reference' entity field type.
 *
 * Extends EntityReferenceItem and only support targeting webform entities.
 *
 * @FieldType(
 *   id = "webform",
 *   label = @Translation("Webform"),
 *   description = @Translation("A webform containing default submission values."),
 *   category = @Translation("Reference"),
 *   default_widget = "webform_entity_reference_select",
 *   default_formatter = "webform_entity_reference_entity_view",
 *   list_class = "\Drupal\webform\Plugin\Field\FieldType\WebformEntityReferenceFieldItemList",
 * )
 */
class WebformEntityReferenceItem extends EntityReferenceItem {

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return [
      'target_type' => 'webform',
    ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    return [
      'default_data' => '',
      'status' => TRUE,
    ] + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'target_id' => [
          'description' => 'The ID of the webform entity.',
          'type' => 'varchar_ascii',
          'length' => 255,
        ],
        'default_data' => [
          'description' => 'Default submission data.',
          'type' => 'text',
        ],
        'status' => [
          'description' => 'Flag to control whether this webform should be open or closed to new submissions.',
          'type' => 'int',
          'size' => 'tiny',
          'unsigned' => TRUE,
          'default' => 1,
        ],
      ],
      'indexes' => [
        'target_id' => ['target_id'],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = parent::propertyDefinitions($field_definition);

    $properties['default_data'] = DataDefinition::create('string')
      ->setLabel(t('Default submission data'));

    $properties['status'] = DataDefinition::create('boolean')
      ->setLabel(t('Status'))
      ->setDescription(t('Flag to control whether this webform should be open or closed to new submissions.'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public static function getPreconfiguredOptions() {
    return [];
  }

}
