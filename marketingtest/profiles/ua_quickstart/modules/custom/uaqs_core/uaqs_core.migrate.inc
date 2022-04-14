<?php

/**
 * @file
 * Provides common base classes that the migrations for features can extend.
 */

/**
 * Establishes conventions for file handling.
 *
 * The default conventions for finding demo content associate local JSON files
 * with each migration, naming each file from the lowercased version of the
 * machine name of the migration. All the JSON files are in the data
 * subdirectory of the directory holding the migration PHP code, and any
 * additional files (PDF documents, JPEG and PNG images) are in a parallel
 * images subdirectory.
 */
abstract class UaqsLocalfileMigration extends Migration {

  /**
   * The path of the import data directory.
   */
  protected $importRoot;

  /**
   * Gets the path of the import data directory.
   *
   * @return string
   *   The path of the directory relative to DRUPAL_ROOT.
   */
  public function getImportRoot() {
    return $this->importRoot;
  }

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments);

    if (isset($arguments['import_root'])) {
      $this->importRoot = $arguments['import_root'];
    }
  }

  /**
   * Gives the path of the directory holding the JSON demo data files.
   *
   * @return string
   *   The path relative to DRUPAL_ROOT.
   */
  public function dataPath() {
    return $this->getImportRoot() . '/data';
  }

  /**
   * Gives the path of the directory holding the image and attachment files.
   *
   * @return string
   *   The path relative to DRUPAL_ROOT.
   */
  public function imagePath() {
    return $this->getImportRoot() . '/images';
  }

  /**
   * Turns a class machine name into the default JSON data file path.
   *
   * @return string
   *   The relative path to the JSON data file.
   */
  public function jsonFilePath() {
    return $this->dataPath() . '/' . drupal_strtolower($this->machineName) . '.json';
  }

}

/**
 * Imports demonstration taxonomy terms from pre-defined data.
 *
 * Terms come from a local JSON-formatted text file, and the overall approach
 * here is similar to the abstract taxonomy migration class in the wine.inc
 * sample code included with the Migrate module, and the documentation for
 * migration sources based on MigrateSourceJSON.
 *
 * @see https://www.drupal.org/node/1152160
 */
abstract class UaqsTermMigration extends UaqsLocalfileMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   * @param string $vocabulary
   *   The machine name of the taxonomy vocabulary into which to import terms.
   * @param string $description
   *   Detailed information describing the migration.
   */
  public function __construct(array $arguments, $vocabulary, $description) {
    parent::__construct($arguments);

    $this->description = $description;

    // Taxonomy term fields.
    $data_fields = array(
      'description' => t('Taxonomy term description'),
      'parent_name' => t('Nest under the term with this name'),
    );

    // Source key field: in our case we use the term names, not numeric IDs.
    $id_field = 'name';
    $source_key = array($id_field => t('Taxonomy term'));

    // All the fields to migrate.
    $fields = $source_key + $data_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $id_field, $fields);

    // Destination, giving the machine name of the vocabulary.
    $this->destination = new MigrateDestinationTerm($vocabulary);

    // The usual migration map, keyed off the source term names.
    $this->map = new MigrateSQLMap($this->machineName,
      array(
        $id_field => array(
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
          'description' => $source_key[$id_field],
        ),
      ),
      MigrateDestinationTerm::getKeySchema()
    );

    // One-to-one correspondence: JSON names and taxonomy fields.
    $this->addSimpleMappings(array_keys($fields));

    // Unmapped fields.
    foreach (array('parent', 'weight', 'format') as $unmapped) {
      $this->addFieldMapping($unmapped)
           ->issueGroup(t('DNM'));
    }
  }

}

/**
 * Defines a migration that uses arbitrary int source keys.
 *
 * Most of the migration sources have int keys for the source records, so the
 * map definitions are all similar.
 *
 * @see https://www.drupal.org/node/1007004
 */
abstract class UaqsIntKeyedMigration extends UaqsLocalfileMigration {

  /**
   * Name and label for the source key.
   */
  protected $sourceKeyField;

  /**
   * Gets the source key field name and description.
   *
   * @return array
   *   An associative array giving the source key field name and description.
   */
  public function getSourceKeyField() {
    return $this->sourceKeyField;
  }

  /**
   * Gets the source key field name.
   *
   * @return string
   *   The name of the key field in the migration source.
   */
  public function getSourceKeyFieldName() {
    $key_field = array_keys($this->sourceKeyField);
    return $key_field[0];
  }

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   * @param string $id_field
   *   Name of the key field in the source records.
   * @param array $dest_key_schema
   *   A Drupal schema definition for the destination key.
   */
  public function __construct(array $arguments, $id_field, array $dest_key_schema) {
    parent::__construct($arguments);

    $this->sourceKeyField = array($id_field => t('Unique key'));
    // The usual migration map, keyed off the arbitrary source IDs.
    $this->map = new MigrateSQLMap($this->machineName,
      array(
        $id_field => array(
          'type' => 'int',
          'unsigned' => TRUE,
          'not null' => TRUE,
          'description' => $this->sourceKeyField[$id_field],
        ),
      ),
      $dest_key_schema
    );
  }

}

/**
 * Defines a customized migration into Drupal nodes.
 *
 * The Migration module's standard MigrateDestinationNode is the basis of this
 * which makes some assumptions to match the rest of the UAQS Demo migrations.
 *
 * @see https://www.drupal.org/node/1349696
 */
abstract class UaqsNodeMigration extends UaqsIntKeyedMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   * @param string $bundle
   *   Node type name.
   * @param string $description
   *   Detailed information describing the migration.
   */
  public function __construct(array $arguments, $bundle, $description) {
    parent::__construct($arguments, 'id', MigrateDestinationNode::getKeySchema());

    $this->description = $description;

    // Destination.
    $this->destination = new MigrateDestinationNode($bundle);

    // Defaults and ignored destination fields...
    $this->addUnmigratedDestinations(array(
      'status', 'promote', 'sticky', 'revision', 'log', 'language', 'tnid',
      'translate', 'revision_uid', 'is_new',
    ));
    // The only user we can count on is User 1.
    $this->addFieldMapping('uid')
         ->defaultValue(1);
    $arbitrary_timestamp = "2015-07-21 09:38:00";
    $this->addFieldMapping('created')
         ->defaultValue($arbitrary_timestamp);
    $this->addFieldMapping('changed')
         ->defaultValue($arbitrary_timestamp);
  }

}

/**
 * Defines a MigrateDestination for entities based on the Bean module.
 *
 * Various proposals in the issue queue for the Bean Module add Migrate
 * support, but (unlike most of the patches there) this uses the Bean API
 * rather than the more generic Entity API.
 *
 * @see https://www.drupal.org/node/2295973
 */
class UaqsMigrateDestinationBean extends MigrateDestinationEntity {

  /**
   * Implements MigrateDestination::getKeySchema().
   *
   * Bean entities use 'bid' as the unique primary key: compare bean_schema()
   * in the Bean module bean.install.
   *
   * @return array
   *   Schema field definition corresponding to the destination primary key.
   */
  static public function getKeySchema() {
    return array(
      'bid' => array(
        'type' => 'int',
        'unsigned' => TRUE,
        'description' => 'ID of destination bean',
      ),
    );
  }

  /**
   * Constructor.
   *
   * @param string $bundle
   *   The particular Bean type.
   * @param array $options
   *   Options applied to Bean entities.
   */
  public function __construct($bundle, array $options = array()) {
    parent::__construct('bean', $bundle, $options);
  }

  /**
   * Generates a list of fields on this Bean type available for mapping.
   *
   * @param object $migration
   *   Optionally, the migration containing this destination.
   *
   * @return array
   *   An associative array giving the field machine names and descriptions.
   */
  public function fields($migration = NULL) {
    // Property fields always defined for Bean entities...
    $property_fields = array(
      'bid' => t('Primary Key: Unique bean item ID.'),
      'vid' => t('Revision ID'),
      'delta' => t('The Block ID (delta) for this bean.'),
      'label' => t('Displays in the Admin page.'),
      'title' => t('The human-readable name of this bean.'),
      'type' => t('The Bean type of this bean.'),
      'view_mode' => t('The View mode to use as the bean.'),
      'data' => t('A serialized array of additional data related to this bean.'),
      'uid' => t('The author ID for the revision.'),
      'created' => t('The Unix timestamp when the bean was created.'),
      'changed' => t('The Unix timestamp when the bean was most recently saved.'),
    );
    // Additional bundle fields for this Bean type...
    $bundle_fields = migrate_handler_invoke_all('Entity', 'fields',
      $this->entityType, $this->bundle, $migration);

    $fields = $property_fields + $bundle_fields;
    return $fields;
  }

  /**
   * Delete a previously migrated bean.
   *
   * @param array $key
   *   Array of one bid, the key for the single bean to delete.
   *
   * @return bool
   *   The status of the delete operation.
   */
  public function rollback(array $key) {
    $bid = reset($key);
    migrate_instrument_start('bean_load');
    $bean = bean_load($bid);
    migrate_instrument_stop('bean_load');
    $is_absent = empty($bean);
    if (!$is_absent) {
      // The bean needs deletion.
      migrate_instrument_start('bean_delete');
      $this->prepareRollback($bid);
      $is_absent = (bool) bean_delete($bean);
      $this->completeRollback($bid);
      migrate_instrument_stop('bean_delete');
    }
    return $is_absent;
  }


  /**
   * Import a single bean.
   *
   * Derived from MigrateDestinationNode::import() code.
   *
   * @param object $dest_bean_vals
   *   A generic object holding fields to create or update a Bean entity.
   * @param object $row
   *   The raw source data object, passed through to prepare/complete handlers.
   *
   * @throws MigrateException
   *   Exceptions are thrown for the same conditions as Node imports.
   *
   * @return array
   *   Array with the successfully saved bean primary key, or FALSE on failure.
   */
  public function import(stdClass $dest_bean_vals, stdClass $row) {
    $migration = Migration::currentMigration();

    // Updating previously-migrated content?
    if (isset($row->migrate_map_destid1)) {
      // Make sure is_new is off.
      $dest_bean_vals->is_new = FALSE;

      if (isset($dest_bean_vals->bid)) {
        if ($dest_bean_vals->bid != $row->migrate_map_destid1) {
          throw new MigrateException(t("Incoming id !bid and map destination bid !destid1 don't match",
            array('!bid' => $dest_bean_vals->bid, '!destid1' => $row->migrate_map_destid1)));
        }
      }
      else {
        $dest_bean_vals->bid = $row->migrate_map_destid1;
      }
      // Get the existing revision ID so updates don't generate notices.
      $values = db_select('bean', 'b')
                ->fields('b', 'vid')
                ->condition('bid', $dest_bean_vals->bid)
                ->execute()
                ->fetchAssoc();
      if (empty($values)) {
        throw new MigrateException(t("Incoming bean ID !bid no longer exists",
                    array('!bid' => $dest_bean_vals->bid)));
      }
      $dest_bean_vals->vid = $values['vid'];
    }

    if ($migration->getSystemOfRecord() == Migration::DESTINATION) {
      if (!isset($dest_bean_vals->bid)) {
        throw new MigrateException(t('System-of-record is DESTINATION, but no destination bid provided'));
      }
      $old_bean = bean_load($dest_bean_vals->bid);
      if (empty($old_bean)) {
        throw new MigrateException(t('System-of-record is DESTINATION, but bean !bid does not exist',
                                   array('!bid' => $dest_bean_vals->bid)));
      }
      if (!isset($dest_bean_vals->created)) {
        $dest_bean_vals->created = $old_bean->created;
      }
      if (!isset($dest_bean_vals->vid)) {
        $dest_bean_vals->vid = $old_bean->vid;
      }
      if (!isset($dest_bean_vals->uid)) {
        $dest_bean_vals->uid = $old_bean->uid;
      }
    }

    if (!isset($dest_bean_vals->type)) {
      $dest_bean_vals->type = $this->bundle;
    }

    // Invoke migration prepare handlers.
    $this->prepare($dest_bean_vals, $row);

    // Trying to update an existing bean.
    if ($migration->getSystemOfRecord() == Migration::DESTINATION) {
      // Incoming data overrides existing data: only copy non-existent fields.
      foreach ($old_bean as $field => $value) {
        // An explicit NULL in the source data means to wipe to old value (i.e.,
        // don't copy it over from $old_bean).
        if (property_exists($dest_bean_vals, $field) && is_null($dest_bean_vals->$field)) {
          // Ignore this field.
        }
        elseif (!isset($dest_bean_vals->$field)) {
          $dest_bean_vals->$field = $old_bean->$field;
        }
      }
    }

    $updating = isset($dest_bean_vals->bid);

    // Make sure that if is_new is not TRUE, it is not present.
    if (isset($dest_bean_vals->is_new) && empty($dest_bean_vals->is_new)) {
      unset($dest_bean_vals->is_new);
    }

    // Validate field data prior to saving.
    field_attach_validate('bean', $dest_bean_vals);

    // Copy the values (from an unstructured stdClass) to a real Bean:
    // some fields (like delta) get good defailts in $bean,
    // but this does not update $dest_bean_vals.
    $bean = bean_create(get_object_vars($dest_bean_vals));

    migrate_instrument_start('bean_save');
    $saved = bean_save($bean);
    migrate_instrument_stop('bean_save');

    if ($saved) {
      if ($updating) {
        $this->numUpdated++;
      }
      else {
        $this->numCreated++;
      }

      // Potentially fix the uid in the bean_revisions table.
      $query = db_update('bean_revision')
               ->condition('vid', $bean->vid);
      if ($bean->uid != $GLOBALS['user']->uid) {
        $fields['uid'] = $bean->uid;
      }
      if (!empty($fields)) {
        // We actually have something to update.
        $query->fields($fields);
        $query->execute();
      }
    }
    $keyarr = ($saved) ? array($bean->bid) : FALSE;

    $this->complete($bean, $row);
    return $keyarr;
  }

}

/**
 * Defines a custom Migrate destination handler for UAQS Content Chunks.
 *
 * Makes the custom 'view_mode' paragraghs_item entity field added by the UAQS
 * Content Chunks module available as a Migrate field destination for any
 * ParagraphsItem migrations.
 */
class UaqsContentChunksHandler extends MigrateDestinationHandler {

  public function __construct() {
    /**
     * Because the arguments here correspond with the $destination argument used
     * in migrate_handler_invoke_all() invocations in the fields() method of
     * any destination classes (and not the actual name of the entity type),
     * 'paragraphs_item' does not work here.
     *
     * @see MigrateDestinationParagraphsItem::fields()
     * @see MigrateHandler::handlesType()
     */
    $this->registerTypes(array('paragraphsitem'));
  }

  /**
   * Make 'view_mode' visible as a destination field.
   */
  public function fields() {
    return array(
      'view_mode' => t('Paragraphs item view_mode (provided by UAQS Content Chunks module).'),
      'bottom_spacing' => t('Paragraphs item bottom_spacing (provided by UAQS Content Chunks module).'),
    );
  }

}

/**
 * Defines a customized migration into Beans (fieldable block entities).
 *
 * The Bean module does not yet support Migrate directly, but the missing
 * MigrateDestination class appears here.
 *
 * @see UaqsMigrateDestinationBean
 */
abstract class UaqsBeanMigration extends UaqsIntKeyedMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   * @param string $bundle
   *   Bean type name.
   * @param string $description
   *   Detailed information describing the migration.
   */
  public function __construct(array $arguments, $bundle, $description) {
    parent::__construct($arguments, 'id',
      UaqsMigrateDestinationBean::getKeySchema());

    $this->description = $description;

    // Destination.
    $this->destination = new UaqsMigrateDestinationBean($bundle);

    // These fields get placeholders, as in Nodes...
    $this->addFieldMapping('uid')
         ->defaultValue(1);
    $arbitrary_timestamp = "2015-07-21 09:38:00";
    $this->addFieldMapping('created')
         ->defaultValue($arbitrary_timestamp);
    $this->addFieldMapping('changed')
         ->defaultValue($arbitrary_timestamp);
    $this->addFieldMapping('view_mode')
         ->defaultValue('default');
  }

}

/**
 * Defines a migration into Beans with explicit placement of the blocks.
 *
 * The Bean module documentation states “The Bean module does not attempt to
 * interface with the placement of blocks. Bean deals only with the creation
 * of customized, fieldable blocks.”
 * https://www.drupal.org/node/1434622
 * However it is often useful for a Bean migration to automatically assign the
 * blocks to regions that the migration data define themselves.
 */
abstract class UaqsPlacedBeanMigration extends UaqsBeanMigration {

  const MISPLACED = 'Cannot place the Bean block in a region.';

  /**
   * Machine name of the default theme for placement regions.
   */
  protected $defaultTheme;

  /**
   * Gets the theme that defines placement regions.
   *
   * @return string
   *   Machine name of the theme.
   */
  public function getDefaultTheme() {
    return $this->defaultTheme;
  }

  /**
   * Machine name of the default placement region.
   */
  protected $defaultRegion;

  /**
   * Gets the default placement region.
   *
   * @return string
   *   Machine name of the region.
   */
  public function getDefaultRegion() {
    return $this->defaultRegion;
  }

  /**
   * Default visibility flag.
   */
  protected $defaultVisibility;

  /**
   * Gets the default visibility flag.
   *
   * @return int
   *   A visibility flag like the one for hook_block_info().
   */
  public function getDefaultVisibility() {
    return $this->defaultVisibility;
  }

  /**
   * Default specification for which pages display the block.
   */
  protected $defaultPages;

  /**
   * Gets the page specifications.
   *
   * @return string
   *   A page specification like the one for hook_block_info().
   */
  public function getDefaultPages() {
    return $this->defaultPages;
  }

  /**
   * Weight for relative ordering of blocks.
   */
  protected $defaultWeight;

  /**
   * Gets the ordering weight..
   *
   * @return int
   *   A number similar to those produced by a user on the block placement GUI.
   */
  public function getDefaultWeight() {
    return $this->defaultWeight;
  }

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   * @param string $bundle
   *   Bean type name.
   * @param string $theme
   *   Machine name for the theme defining the block placement regions.
   * @param string $region
   *   Machine name for the region into which to place the blocks.
   * @param int $visibility
   *   The visibility flag, modifying the interpretation of the $pages value.
   * @param string $pages
   *   Paths or custom code defining where to display the block.
   * @param int $weight
   *   Ordering weight to give to the block..
   * @param string $description
   *   Detailed information describing the migration.
   *
   * @see https://api.drupal.org/api/drupal/modules!block!block.api.php/function/hook_block_info/7.x
   */
  public function __construct(array $arguments, $bundle, $theme, $region, $visibility, $pages, $weight, $description) {
    parent::__construct($arguments, $bundle, $description);

    $this->defaultTheme = $theme;
    $this->defaultRefgion = $region;
    $this->defaultVisibility = $visibility;
    $this->defaultPages = $pages;
    $this->defaultWeight = $weight;
    $this->description = $description;

  }

  /**
   * Place a Bean block in a region.
   *
   * @param object $entity
   *   The Bean that has just updated the database.
   * @param object $row
   *   Object containing raw source data (from the JSON file).
   * @throws MigrateException
   *   Warnings if the automatic block placement fails.
   */
  public function complete($entity, stdClass $row) {

    if (empty($row) || !isset($row->id)) {
      Migration::displayMessage(t('No imported row found when trying to place a Bean block.'));
      throw new MigrateException(self::MISPLACED);
    }
    if (empty($entity) || !isset($entity->bid)) {
      Migration::displayMessage(t('No saved Bean block to place for row ID !rowid.',
        array('!rowid' => $row->id)));
      throw new MigrateException(self::MISPLACED);
    }
    if (empty($entity->delta)) {
      Migration::displayMessage(t('No delta for Bean block bid = !bid placed from row !rowid.',
        array('!bid' => $entity->bid, '!rowid' => $row->id)));
      throw new MigrateException(self::MISPLACED);
    }
    $theme = (isset($row->theme)) ? $row->theme : $this->getDefaultTheme();
    $region = (isset($row->region)) ? $row->region : $this->getDefaultRegion();
    $visibility = (isset($row->visibility)) ? $row->visibility : $this->getDefaultVisibility();
    $pages = (isset($row->pages)) ? $row->pages : $this->getDefaultPages();
    $weight = (isset($row->weight)) ? $row->weight : $this->getDefaultWeight();
    try {
      $nupdated = db_update('block')
        ->fields(array('region' => $region, 'status' => 1, 'visibility' => $visibility, 'pages' => $pages, 'weight' => $weight))
        ->condition('module', 'bean')
        ->condition('delta', $entity->delta)
        ->condition('theme', $theme)
        ->execute();
    }
    catch(Exception $e) {
      Migration::displayMessage(t('Database error when placing block !delta from row !rowid: !dberr',
        array('!delta' => $entity->delta, '!rowid' => $row->id, '!dberr' => $e->getMessage())));
      throw new MigrateException(self::MISPLACED);
    }
    if ($nupdated == 0) {
      Migration::displayMessage(t('No database changes for Bean block !delta placed from row !rowid.',
        array('!delta' => $entity->delta, '!rowid' => $row->id)));
      throw new MigrateException(self::MISPLACED);
    }
  }

}

/**
 * Defines a migration into a Field Collection.
 *
 * The Migration module has no direct support for Field Collections
 * (which are use freestanding entities, distinct from nodes), but the
 * Field Collection module itself defines a Migration api. Here we adopt some
 * additional constraints: the host entity is always a node, and there is
 * only one migration dependency, which is also the source migration.
 *
 * @see https://www.drupal.org/node/1900640
 */
abstract class UaqsFieldCollectionMigration extends UaqsIntKeyedMigration {

  /**
   * Name and label for the foreign key.
   */
  protected $foreignKeyField;

  /**
   * Gets the foreign key field name and description.
   *
   * @return array
   *   An associative array giving the foreign key field name and description.
   */
  public function getForeignKeyField() {
    return $this->foreignKeyField;
  }

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   * @param string $bundle
   *   Name of the field where the collection attaches to the node.
   * @param string $host_entity_id
   *   Name of the field holding the foreign key (the associated node id).
   * @param string $host_entity_migration
   *   Name of the migration for the associated nodes.
   * @param string $description
   *   Detailed information describing the migration.
   */
  public function __construct(array $arguments, $bundle, $host_entity_id, $host_entity_migration, $description) {
    parent::__construct($arguments, 'id', MigrateDestinationFieldCollection::getKeySchema());

    $this->description = $description;

    // Foreign key.
    $this->foreignKeyField = array(
      $host_entity_id => t('ID of the parent item'),
    );
    $this->destination = new MigrateDestinationFieldCollection(
      $bundle,
      array('host_entity_type' => 'node')
    );

    // Linking back to parent items on the foreign key.
    $this->addFieldMapping('host_entity_id', $host_entity_id)
         ->sourceMigration($host_entity_migration);
  }

}

/**
 * Defines a migration into a Field Collection in a Paragraphs Item.
 *
 * The Migration module has no direct support for Field Collections
 * (which are use freestanding entities, distinct from nodes), but the
 * Field Collection module itself defines a Migration api. Here we adopt some
 * additional constraints: the host entity is always a node, and there is
 * only one migration dependency, which is also the source migration.
 *
 * @see https://www.drupal.org/node/1900640
 */
abstract class UaqsParagraphsFieldCollectionMigration extends UaqsIntKeyedMigration {

  /**
   * Name and label for the foreign key.
   */
  protected $foreignKeyField;

  /**
   * Gets the foreign key field name and description.
   *
   * @return array
   *   An associative array giving the foreign key field name and description.
   */
  public function getForeignKeyField() {
    return $this->foreignKeyField;
  }

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   * @param string $bundle
   *   Name of the field where the collection attaches to the node.
   * @param string $host_entity_id
   *   Name of the field holding the foreign key (the associated node id).
   * @param string $host_entity_migration
   *   Name of the migration for the associated nodes.
   * @param string $description
   *   Detailed information describing the migration.
   */
  public function __construct(array $arguments, $bundle, $host_entity_id, $host_entity_migration, $description) {
    parent::__construct($arguments, 'id', MigrateDestinationFieldCollection::getKeySchema());

    $this->description = $description;

    // Foreign key.
    $this->foreignKeyField = array(
      $host_entity_id => t('ID of the parent item'),
    );
    $this->destination = new MigrateDestinationFieldCollection(
      $bundle,
      array('host_entity_type' => 'paragraphs_item')
    );

    // Linking back to parent items on the foreign key.
    $this->addFieldMapping('host_entity_id', $host_entity_id)
         ->sourceMigration($host_entity_migration);
  }

}

/**
 * Defines a migration into a Field Collection in a Bean.
 *
 * The Migration module has no direct support for Field Collections
 * (which are use freestanding entities, distinct from nodes), but the
 * Field Collection module itself defines a Migration api. Here we adopt some
 * additional constraints: the host entity is always a bean, and there is
 * only one migration dependency, which is also the source migration.
 *
 * @see https://www.drupal.org/node/1900640
 */
abstract class UaqsBeanFieldCollectionMigration extends UaqsIntKeyedMigration {

  /**
   * Name and label for the foreign key.
   */
  protected $foreignKeyField;

  /**
   * Gets the foreign key field name and description.
   *
   * @return array
   *   An associative array giving the foreign key field name and description.
   */
  public function getForeignKeyField() {
    return $this->foreignKeyField;
  }

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   * @param string $bundle
   *   Name of the field where the collection attaches to the node.
   * @param string $host_entity_id
   *   Name of the field holding the foreign key (the associated node id).
   * @param string $host_entity_migration
   *   Name of the migration for the associated beans.
   * @param string $description
   *   Detailed information describing the migration.
   */
  public function __construct(array $arguments, $bundle, $host_entity_id, $host_entity_migration, $description) {
    parent::__construct($arguments, 'id', MigrateDestinationFieldCollection::getKeySchema());

    $this->description = $description;

    // Foreign key.
    $this->foreignKeyField = array(
      $host_entity_id => t('ID of the parent item'),
    );
    $this->destination = new MigrateDestinationFieldCollection(
      $bundle,
      array('host_entity_type' => 'bean')
    );

    // Linking back to parent items on the foreign key.
    $this->addFieldMapping('host_entity_id', $host_entity_id)
         ->sourceMigration($host_entity_migration);
  }
}


/**
 * Defines migration into Paragraphs Items.
 *
 * The Migration module has no direct support for Paragraphs Items
 * (which are use freestanding entities, distinct from nodes), but the
 * Paragraphs module itself defines a Migration api.
 */
abstract class UaqsParagraphsItemMigration extends UaqsIntKeyedMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   * @param string $bundle
   *   The Paragraph type machine name.
   * @param string $field_name
   *   Name of the field where the Paragraphs attach to a host entity.
   * @param string $description
   *   Detailed information describing the migration.
   */
  public function __construct(array $arguments, $bundle, $field_name, $description) {
    parent::__construct($arguments, 'id', MigrateDestinationParagraphsItem::getKeySchema());

    $this->description = $description;
    $this->destination = new MigrateDestinationParagraphsItem(
      $bundle,
      array(
        'field_name' => $field_name,
        'text_format' => 'uaqs_textual_content',
      )
    );
  }

}

/**
 * Defines a customized migration into Drupal menu items.
 *
 * The Migration module's standard MigrateDestinationMenuLinks is the basis of
 * this, which makes some assumptions to match the rest of the UAQS Demo
 * migrations.
 */
abstract class UaqsMenuLinksMigration extends UaqsIntKeyedMigration {

  /**
   * Name and label for the foreign key.
   */
  protected $parentLinkField;

  /**
   * Gets the parent link field name and description.
   *
   * @return array
   *   An associative array giving the parent link field name and description.
   */
  public function getParentLinkField() {
    return $this->parentLinkField;
  }

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   * @param string $plid
   *   Name of the field holding the menu item's parent link ID.
   * @param string $description
   *   Detailed information describing the migration.
   */
  public function __construct(array $arguments, $plid, $description) {
    parent::__construct($arguments, 'mlid', MigrateDestinationMenuLinks::getKeySchema());

    $this->description = $description;

    // Parent of this menu item.
    $this->parentLinkField = array(
      $plid => t('ID of the parent item'),
    );

    // Destination.
    $this->destination = new MigrateDestinationMenuLinks();

    // Look up the parent ID using our own map.
    $this->addFieldMapping('plid', $plid)
         ->sourceMigration($this->getMachineName());

    // Defaults and ignored destination fields...
    $this->addUnmigratedDestinations(array(
      'options', 'module', 'hidden',
      'p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8', 'p9', 'updated',
    ));
    $this->addFieldMapping('router_path')
         ->defaultValue('node/%');
    $this->addFieldMapping('has_children')
         ->defaultValue('0');
    $this->addFieldMapping('depth')
         ->defaultValue('1');
    $this->addFieldMapping('customized')
         ->defaultValue('1');
  }

}
