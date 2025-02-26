<?php

use PSpell\Config;

    class Auteur{
        /**
         * numero de l'auteur
         * @var int
         */
        private $num;

        /**
         * nom del'auteur
         * @var string
         */
        private $nom;


        /**
         *  prenom de l'auteur
         * @var string
         */
        private $prenom;


        /**
         * nationalite
         * @var string
         */
        private $numNationalite;



        /**
         * retourne l'ensemble des auteurs
         *
         * @return Auteur[] tab d'objet auteur
         */
        public static function findAll() :array
        {
            $req=MonPdo::getInstance()->prepare("Select num, nom, prenom from auteur");
            $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Auteur');
            $req->execute();
            $lesResultats=$req->fetchAll();
            return $lesResultats;
        }

        /**
         * Trouve un auteur par son nom
         *
         * @param integer $id numero du auteur
         * @return Auteur objet auteur trouvé
         */
        public static function findById(int $id) :Auteur
        {
            $req=MonPdo::getInstance()->prepare("Select * from auteur where num= :id");
            $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Auteur');
            $req->bindParam(':id',$id);
            $req->execute();
            $leResultat=$req->fetch();
            return $leResultat;
        }


        /**
         * Ajout d'un auteur
         *
         * @param Auteur $auteur auteur à ajouter
         * @return integer resultat (1 si l'operation a reussi, 0 sinon)
         */
        public static function add(Auteur $auteur): int
        {
            $req=MonPdo::getInstance()->prepare("insert into auteur(nom,prenom,nationalite) values(:nom,:prenom,:nationalite)");
            $nom=$auteur->getNom();
            $prenom=$auteur->getPrenom();
            $nationalite=$auteur->getNationalite();
            $req->bindParam(':nom',$nom);
            $req->bindParam(':prenom', $prenom);
            $req->bindParam(':nationalite', $nationalite);
            $nb=$req->execute();
            return $nb;
        }



        /**
         * modifier un auteur
         *
         * @param Auteur $auteur auteur à modifier
         * @return integer resultat (1 si l'operation a reussi, 0 sinon)
         */
        public static function update(Auteur $auteur): int
        {
            $req=MonPdo::getInstance()->prepare("update auteur set(nom=:nom, prenom=:prenom, nationalite=:nationalite) where num= :id");
            $num=$auteur->getNum();
            $nom=$auteur->getNom();
            $prenom=$auteur->getPrenom();
            $nationalite=$auteur->getNationalite();

            $req->bindParam(':id',$num);
            $req->bindParam(':nom',$nom);
            $req->bindParam(':prenom',$prenom);
            $req->bindParam(':nationalite',$nationalite);
            $nb=$req->execute();
            return $nb;
        }


        /**
         * Supprimer un auteur
         *
         * @param Auteur $auteur
         * @return integer
         */
        public static function delete(Auteur $auteur) :int
        {
            $req=MonPdo::getInstance()->prepare("delete from auteur where num= :id");
            $num=$auteur->getNum();
            $req->bindParam(':id',$num);
            $nb=$req->execute();
            return $nb;
        }
        

        ////// GETTERS ET SETTER



        //GETSETTER DU NUM
        /**
         * Get numero de l'auteur
         *
         * @return  int
         */ 
        public function getNum()
        {
                return $this->num;
        }
        /**
         * Set numero de l'auteur
         *
         * @param  int  $num  numero de l'auteur
         *
         * @return  self
         */ 
        public function setNum(int $num)
        {
                $this->num = $num;

                return $this;
        }




        // GETSETTER DU NOM 
        /**
         * Get nom del'auteur
         *
         * @return  string
         */ 
        public function getNom()
        {
                return $this->nom;
        }
        /**
         * Set nom del'auteur
         *
         * @param  string  $nom  nom del'auteur
         *
         * @return  self
         */ 
        public function setNom(string $nom)
        {
                $this->nom = $nom;

                return $this;
        }

        //GETSETTER DU PRENOM
        /**
         * Get prenom de l'auteur
         *
         * @return  string
         */ 
        public function getPrenom()
        {
                return $this->prenom;
        }
        /**
         * Set prenom de l'auteur
         *
         * @param  string  $prenom  prenom de l'auteur
         *
         * @return  self
         */ 
        public function setPrenom(string $prenom)
        {
                $this->prenom = $prenom;

                return $this;
        }




        /// GETSETTER NATIONALITE
        /**
         * Get nationalite
         *
         * @return Nationalite
         */ 
        public function getNationalite(): Nationalite
        {       
                return Nationalite::findById($this->numNationalite); 
        }
        /**
         * Set nationalite
         *
         * @return  self
         */ 
        public function setNationalite(Nationalite $nationalite) :self
        {
                $this->numNationalite = $nationalite->getNum();
                return $this;
        }


        
    }