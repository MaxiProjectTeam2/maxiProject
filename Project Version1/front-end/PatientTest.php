<?php
namespace stats\Test;

use stats\Test\getPatients; // change this
//include 'getPatients.php';

class PatientTest extends \PHPUnit_Framework_TestCase{

  public function testGetPatients(){
    $set = new getPatients();
    $result = $set->getMatches("smith");
    $p = array(array("Bob","Smith"),
      array("Sally","Smith"));
    $expectedResult = $p;
    $this->assertEquals($expectedResult,$result);
  }

}

?>
