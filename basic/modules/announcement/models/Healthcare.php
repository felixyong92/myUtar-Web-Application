<?php

namespace app\modules\announcement\models;

use Yii;
use app\models\Department;
/**
 * This is the model class for table "healthcare".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $publishDate
 * @property string $image
 * @property string $attachment
 * @property string $link
 * @property integer $status
 * @property string $dId
 *
 * @property Department $d
 */
class Healthcare extends \yii\db\ActiveRecord
{

    public $images_Temp;
    public $attachments_Temp;


     public function getStatusText() {
            return $this->statusOptions[$this->status];
    }
    
    public function getStatusOptions() {
            return array(
                    0 => 'Active',
                    1 => 'Archived',
            );
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'healthcare';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','dId'], 'required'],
            [['description'], 'string'],
            [['publishDate'], 'safe'],
            [['status'], 'integer'],
            [['title'], 'string', 'max' => 200],
            [['image', 'attachment'], 'string', 'max' => 1000],
            [['link'], 'string', 'max' => 255],
            [['dId'], 'string', 'max' => 20],
            [['dId'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['dId' => 'dId']],
            [['images_Temp', 'attachments_Temp'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'publishDate' => 'Publish Date',
            'image' => 'Images',
            'attachment' => 'Attachments',
            'link' => 'Link',
            'status' => 'Status',
            'dId' => 'Department',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['dId' => 'dId']);
    }
}
