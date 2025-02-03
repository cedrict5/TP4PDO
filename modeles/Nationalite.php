<?php
    class Nationalite{
        /**
         * numero de nationalité
         * @var int
         */
        private $num;
        
        /**
         * libelle de nationalité
         * @var string
         */
        private $libelle;

        /**
         * num continent(clé etrangere) relié à num de continent
         *
         * @var int
         */
        private $numContinent;  



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
         * Get the value of numContinent
         */ 
        public function getNumNationalite()
        {
            $this->$numContinent = $numContinent;
                return $this;
        }

        /**
         * Set the value of numComtinent
         *
         * @return  self
         */ 
        public function setNumContinent($numContinent)
        {
                $this->numContinent = $numContinent;

                return $this;
        }


        /**
         * retourne l'ensemble des Nationalite
         *
         * @return Nationalite[] tab d'objet Nationalite
         */
        public static function findAll() :array
        {
            $req=MonPdo::getInstance()->prepare("Select * from nationalite");
            $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Nationalite');
            $req->execute();
            $lesResultats=$req->fetchAll();
            return $lesResultats;
        }

        /**
         * Trouve un continent par son nom
         *
         * @param integer $id numero du continent
         * @return Continent objet continent trouvé
         */
        public static function findById(int $id) :Continent
        {
            $req=MonPdo::getInstance()->prepare("Select * from nationalite where num= :id");
            $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Continent');
            $req->bindParam(':id',$id);
            $req->execute();
            $lesResultats=$req->fetchAll();
            return $lesResultats;
        }


        /**
         * Ajout d'un continent
         *
         * @param Continent $continent continent à ajouter
         * @return integer resultat (1 si l'operation a reussi, 0 sinon)
         */
        public static function add(Continent $continent): int
        {
            $req=MonPdo::getInstance()->prepare("insert into continent(libelle) values(:libelle)");
            $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Continent');
            $req->bindParam(':id',$continent->getLibelle());
            $nb=$req->execute();
            return $nb;
        }



        /**
         * modifier un continent
         *
         * @param Continent $continent continent à modifier
         * @return integer resultat (1 si l'operation a reussi, 0 sinon)
         */
        public static function update(Nationalite $nationalite): int
        {
            $req=MonPdo::getInstance()->prepare("update nationalite set libelle= :libelle where num= :num");
            $req->bindParam(':id',$nationalite->getNum());
            $req->bindParam(':id',$nationalite->getLibelle());
            $nb=$req->execute();
            return $nb;
        }


        /**
         * Supprimer un continent
         *
         * @param Continent $continent
         * @return integer
         */
        public static function delete(Nationalite $nationalite) :int
        {
            $req=MonPdo::getInstance()->prepare("delete from nationalite where num= :id");
            $req->bindParam(':id',$nationalite->getNum());
            $nb=$req->execute();
            return $nb;
        }
        

        
    }