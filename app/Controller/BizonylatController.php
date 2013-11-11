<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Vic
 * Date: 2013.11.10.
 * Time: 11:52
 * To change this template use File | Settings | File Templates.
 */
App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');
App::uses('Bizonylat', 'Model');
App::uses('BizonylatUtils', 'Controller');
App::uses('CommonUtils', 'Controller');

class BizonylatController extends AppController {
	
	public function penztarKonyvel(){
		$bizonylatok = CommonUtils::csvToKeyArray('export.csv',';');
		
		debug($bizonylatok);
		
		$this->bizonylatMent($bizonylatok);
	}

    public function bizonylatMent($bizonylatok) {
        $tetelSorszam = $this->findLastTetelSorszam();
		debug($tetelSorszam);

        foreach($bizonylatok as $bizonylat){
        	debug($bizonylat);
            $this->Bizonylat->create();

            $bizonylatDatuma = $bizonylat->bizonylatDatuma;

            $data = array('tetelSorszam' => $tetelSorszam + 1,
                'bizonylatSzama' => BizonylatUtils::genBizonylatSzam($bizonylatDatuma, $bizonylat->kiBe, $tetelSorszam),
                'bankPenztar' => PENZTAR,
                'rogzitesDatuma' => CakeTime::dayAsSql(getdate(), 'rogzitesDatuma'),
                'bizonylatDatuma' => CakeTime::dayAsSql($bizonylatDatuma, 'bizonylatDatuma'),
                'leiras' => $bizonylat->leiras,
                'partnerId' => BizonylatUtils::parseId($bizonylat->partner),
                'osszeg' => $bizonylat->osszeg,
                'alszamId' => BizonylatUtils::parseId($bizonylat->alszam),
                'fkSzam' => '',
                'kiBe' => BizonylatUtils::parseId($bizonylat->kiBe),
                'nevjegyzekbeRogzitve' => 0,
                'konyvelesiEv' => date('Y')
            );
			
			debug($data);
            //$this->Bizonylat->save($data);
        }
    }

    private function findLastTetelSorszam(){
        return $this->Bizonylat->find('all', array(
            'conditions' => array('konyvelesiEv' => date('Y')),
            'fields' => array('MAX(Bizonylat.tetelSorszam) AS tetelSorszam', '*')
        ))->tetelSorszam;
    }
}