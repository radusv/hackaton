<?php
namespace App\Model\Table;

use App\Model\Entity\Location;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Locations Model
 *
 * @property \Cake\ORM\Association\HasMany $Groups
 * @property \Cake\ORM\Association\HasMany $Items
 */
class LocationsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('locations');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->hasMany('Groups', [
            'foreignKey' => 'location_id'
        ]);
        $this->hasMany('Items', [
            'foreignKey' => 'location_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');
            
        $validator
            ->requirePresence('url', 'create')
            ->notEmpty('url');

        return $validator;
    }
}
