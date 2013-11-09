App::uses('AppModel', 'Model');
class Alszam extends AppModel {
    public $useTable = 'alszamok'; 
    public $primaryKey = 'alszamId';
    
     public $belongsTo = array(
        'FokonyviSzam' => array(
            'foreignKey' => 'fszId'
        )
    );
}