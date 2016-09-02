<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Exception\CoreConfigKeyNotFoundException;

/**
 * Configs Model
 *
 * @method \App\Model\Entity\Config get($primaryKey, $options = [])
 * @method \App\Model\Entity\Config newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Config[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Config|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Config patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Config[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Config findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ConfigsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('configs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('config_key', 'create')
            ->notEmpty('config_key');

        $validator
            ->requirePresence('config_value', 'create')
            ->notEmpty('config_value');

        return $validator;
    }

    public function getValue()
    {
        $query = $this->find()
            ->hydrate(false)
            ->where(['config_key' => 'somekey']); // this will always fail.

        $config = $query->first();

        if (is_null($config)) {
            throw new CoreConfigKeyNotFoundException('Config key {0} not found.');
        }

        return strval($config['config_value']);
    }
}
