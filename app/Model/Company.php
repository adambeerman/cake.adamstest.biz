<?php
/**
 * Created by JetBrains PhpStorm.
 * User: adam
 * Date: 3/10/14
 * Time: 11:58 AM
 * To change this template use File | Settings | File Templates.
 */

App::uses('AppModel', 'Model');

class Company extends AppModel {

    public $hasMany = array(
        'Refinery' => array(
            'className' => 'Refinery',
            'foreignKey' => 'company_id'
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'company_id'
        )
    );

    public $displayField = 'name';

    public function find_company_from_email($email = null) {

        // Chop the prefix from the e-mail, and check that with database
        $emailSuffix = htmlspecialchars(
            strtolower(
                end(
                    explode('@',$email)
                )
            )
        );
        $company = $this->findBySuffix($emailSuffix);

        //Return the company id if it exists. Else, return false;
        if(isset($company['Company']['id'])) {
            return $company['Company']['id'];
        }
        else {

            // Later, user will be prompted to choose a company.
            return 0;
        }
    }
}