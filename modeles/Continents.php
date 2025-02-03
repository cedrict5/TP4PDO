<?php 
    class Continent{
        /**
         * numero du continent
         * @var int
         */
        private $num;

        /**
         * libelle du continent
         * @var string
         */
        private $libelle;



        /**
         * Get the value of num
         */ 
        public function getNum()
        {
            return $this->num;
        }

        /**
         * lit le libellé
         *
         * @return string
         */
        public function getLibelle() : string
        {
            return $this->libelle;
        }

        /**
         * ecrit ds le libelle
         *
         * @param string $libelle
         * @return self
         */
        public function setLibelle(string $libelle) : self
        {
            $this->libelle = $libelle;

            return $this;
        }


        /**
         * retourne l'ensemble des continents
         *
         * @return Continent[] tab d'objet continent
         */
        public static function findAll() :array
        {
            $req=MonPdo::getInstance()->prepare("Select * from continent");
            $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Continent');
            $req->execute();
            $lesResultats=$req->fetchAll();
            return $lesResultats;


        }
    }