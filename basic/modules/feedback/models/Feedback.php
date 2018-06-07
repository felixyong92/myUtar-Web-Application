<?php

namespace app\modules\feedback\models;

use Yii;
use app\models\Department;
use app\models\UserNew;
/**
 * This is the model class for table "feedback".
 *
 * @property string $fId
 * @property integer $fType
 * @property string $fDateTime
 * @property string $fContent
 * @property string $fAttachment
 * @property string $uId
 * @property string $dId
 * @property integer $fStatus
 *
 * @property Department $d
 * @property User $u
 * @property FeedbackResponse[] $feedbackResponses
 * @property Satisfaction[] $satisfactions
 */
class Feedback extends \yii\db\ActiveRecord
{

    // public $image1;
    // public $image2;
    // public $image3;

    public $attachment1;
    public $attachment2;
    public $attachment3;
    
     public function getTypeText() {
            return $this->typeOptions[$this->fType];
    }
    
    public function getTypeOptions() {
            return array(
                    0 => 'Academic Matters - unit registration, assessment, timetable, etc',
                    1 => 'Admission, Enrolment and Credit Transfer Matters',
                    2 => 'Alumni and Graduates Matters - convocation, job zone, etc.',
                    3 => 'Examinations - procedures, timetable, venue, results, etc',
                    4 => 'Fees and Refunds',
                    5 => 'General Cleanliness and Upkeep',
                    6 => 'General Facilities - air-con, building maintenance, etc',
                    7 => 'IT Hardware - Computer labs, printer, network, etc',
                    8 => 'IT Software - Student portal, systems, etc
',
                    9 => 'Labs, Teaching Facilites at Faculty/Centre',
                    10 => 'Library Facilities and Services',
                    11 => 'Loans and Scholarships - PTPTN, other loans, etc',
                    12 => 'Security and Car Parking - Safety, guards, parking, etc',
                    13 => 'Student Services- bus schedule, car stickers, sport facilities, etc.',
                    14 => 'UTAR Bus Service',
                    15 => 'UTAR Policy Matters, Rules and Regulations',
               
            );
    }

    public function getStatusText() {
            return $this->statusOptions[$this->fStatus];
    }
    
    public function getStatusOptions() {
            return array(
                    0 => 'New',
                    1 => 'Processing',
                    2 => 'Closed(Pending)',
                    3 => 'Reopened',
                    4 => 'Closed',
            );
    }

     public function getStatusAvailable() {
            return array(
                    1 => 'Processing',
                    2 => 'Closed(Pending)',
                    
            );
    }
    

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fType', 'uId', 'dId'], 'required'],
            [['fType', 'fStatus'], 'integer'],
			[['fStatus'],'default','value'=>$this->fStatus],
            [['fDateTime'], 'safe'],
            [['fContent'], 'string'],
            [['fAttachment'], 'string', 'max' => 1000],
            [['uId', 'dId'], 'string', 'max' => 20],
            [['dId'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['dId' => 'dId']],
            [['uId'], 'exist', 'skipOnError' => true, 'targetClass' => UserNew::className(), 'targetAttribute' => ['uId' => 'uId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fId' => 'Feedback ID',
            'fType' => 'Feedback Type',
            'fDateTime' => 'Feedback Submitted DateTime',
            'fContent' => 'Content',
            'fAttachment' => 'Attachment',
            'uId' => 'User ID',
            'dId' => 'Department',
            'fStatus' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['dId' => 'dId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserNew::className(), ['uId' => 'uId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbackResponses()
    {
        return $this->hasMany(FeedbackResponse::className(), ['fId' => 'fId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSatisfactions()
    {
        return $this->hasMany(Satisfaction::className(), ['fId' => 'fId']);
    }
}
