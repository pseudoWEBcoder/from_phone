<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "helptext".
 *
 * @property int $id
 * @property string|null $command
 * @property int|null $created
 * @property int|null $updated
 * @property string|null $help
 * @property string|null $source
 */
class Helptext extends \yii\db\ActiveRecord
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
            [['command', 'help', 'source'], 'string'],
            [['created', 'updated'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'command' => 'Command',
            'created' => 'Created',
            'updated' => 'Updated',
            'help' => 'Help',
            'source' => 'Source',
        ];
    }
}
