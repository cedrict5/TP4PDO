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
         * num nationalite(clé etrangere) relié à num de nationalite
         *
         * @var int
         */
        private $numContinent;  



        /**
         * Get the value of num
         */ 
        public function getNum() : int
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
         * renvoie l'objet continent associé
         *
         * @return Continent
         */
        public function getNumContinent() : Continent
        {
            return Continent::findById($this->numContinent);
        }

        /**
         * Set the value of numContinent
         *
         * @return  self
         */ 
        public function setNumContinent(continent $continent) :self
        {
                $this->numContinent = $continent->getNum();
                return $this;
        }


        /**
         * retourne l'ensemble des Nationalite
         *
         * @return Nationalite[] tab d'objet Nationalite
         */
        public static function findAll() :array
        {
            $req=MonPdo::getInstance()->prepare("select n.num as 'numero', n.libelle as 'libNation', c.libelle as 'libContinent'  from nationalite n, continent c where n.numContinent=c.num");
            $req->setFetchMode(PDO::FETCH_OBJ);
            $req->execute();
            $lesResultats=$req->fetchAll();
            return $lesResultats;
        }

        /**
         * Trouve une nationalite par son nom
         *
         * @param integer $id numero du nationalite
         * @return Nationalite objet nationalite trouvé
         */
        public static function findById(int $id) :Nationalite 
        {
            $req=MonPdo::getInstance()->prepare("Select * from nationalite where num= :id");
            $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Nationalite');
            $req->bindParam(':id',$id);
            $req->execute();
            $lesResultats=$req->fetch();
            return $lesResultats;
        }


        /**
         * Ajout d'une nationalite
         *
         * @param Nationalite $nationalite nationalite à ajouter
         * @return integer resultat (1 si l'operation a reussi, 0 sinon)
         */
        public static function add(Nationalite $nationalite): int
        {
            $req=MonPdo::getInstance()->prepare("insert into nationalite(libelle,numContinent) values(:libelle, :numContinent)");
            $req->bindParam(':libelle',$nationalite->getLibelle());
            $req->bindParam(':numContinent',$nationalite->numContinent);
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
            $req=MonPdo::getInstance()->prepare("update nationalite set libelle= :libelle, numContinent= :numContinent where num= :id");
            $req->bindParam(':id',$nationalite->getNum());
            $req->bindParam(':libelle',$nationalite->getLibelle());
            $req->bindParam(':numContinent',$nationalite->numContinent);
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