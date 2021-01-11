<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "helptext".
 *
 * @property int $id
 * @property string|null $command
 * @property int|null $created
 * @property int|null $updated
 * @property string|null $help
 * @property string|null $decr
 * @property string|null $example
 * @property string|null $parsed
 * @property string|null $source
 * @property string|null $device
 * @property string|null $dop_info
 * @property int|null $weight
 */
class Helptext extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'helptext';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['command', 'help', 'decr', 'example', 'parsed', 'source', 'device', 'dop_info'], 'string'],
            [['created', 'updated', 'weight'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'command' => 'команда',
            'created' => 'создан',
            'updated' => 'обновлен',
            'help' => 'справка',
            'decr' => 'описание',
            'example' => 'пример',
            'parsed' => 'парсеный',
            'source' => 'источник',
            'device' => 'устройство',
            'dop_info' => 'доп инфо',
            'weight' => 'вес',
        ];
    }
}
