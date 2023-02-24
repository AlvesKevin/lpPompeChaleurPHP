<?php
$rootPath = './';
if($_SERVER['DOCUMENT_ROOT'] != '') {
    $rootPath = $_SERVER['DOCUMENT_ROOT'] . '/camille/php/';
}
require_once($rootPath . 'DBUtilities.php');

class pac
{
    use DBUtilities;

    private array $columns;
    private string $table = 'people';

    /**
     * Constructor of the class
     *
     * @param PDO
     * @return User Object
     */
    public function __construct(private PDO $dbh)
    {
        $this->getColumns();
    }


    /**
     * Create a new user
     *
     * @param array $values
     * @return boolean
     */

    public function create($values)
    {
        $values['password'] = password_hash($values['password'], PASSWORD_DEFAULT);
        try {
            $query = $this->dbh->prepare('INSERT INTO pac(name, first_name, address, postal_code, town, email, cgu, status, heating, accomodation, male, female, other_sex) VALUES(:name, :first_name, :address, :postal_code, :town, :email, :cgu, :status, :heating, :accomodation, :male, :female, :other_sex');
            return $query->execute($this->filter($values));
        } catch (PDOException $e) {
            print "Erreur: " . $e->getMessage() . "<br>";
            return false;
        }
    }
}