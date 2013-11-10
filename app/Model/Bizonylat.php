<?php

define("PENZTAR", 'penztar');

App::uses('AppModel', 'Model');
class Bizonylat extends AppModel {
    public $useTable = 'bizonylatok';
    public $primaryKey = 'bizId';
    
    public $belongsTo = array(
        'Partner' => array(
            'foreignKey' => 'partnerId'
        ),
        'Alszam' => array(
            'foreignKey' => 'alszamId'
        )
    );


}