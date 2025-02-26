<?php

use PSpell\Config;

    class Livre{
        /**
         * numero du livre #setter
         * @var int
         */
        private $num;

        /**
         * titre du livre #gettersetter
         * @var string
         */
        private $titre;

        /**
         * identifiant Isbn #gettersetter
         * @var string
         */
        private $isbn;

        /**
         * Undocumented function #gettersetter
         *
         * @return int
         */
        private $prix;

        /**
         * nom de l' editeur #gettersetter
         * @var string
         */
        private $editeur;

        /**
         * Année de parution #gettersetter
         * @var int;
         */
        private $annee;

        /**
         * nom de l'auteur #gettersetter
         * @var string
         */
        private $auteur;

        /**
         * genre du livre #gettersetter
         * @var 
         */
        private $genre;


        /**
         * Get the value of num
         */ 
        public function getNum()
        {
            return $this->num;
        }

    


        /**
         * retourne l'ensemble des livres
         *
         * @return Livre[] tab d'objet livre
         */
        public static function findAll() :array
        {
            $req=MonPdo::getInstance()->prepare("Select * from livre");
            $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Livre');
            $req->execute();
            $lesResultats=$req->fetchAll();
            return $lesResultats;
        }

        /**
         * Trouve un livre par son nom
         *
         * @param integer $id numero du livre
         * @return Livre objet livre trouvé
         */
        public static function findById(int $id) :Livre
        {
            $req=MonPdo::getInstance()->prepare("Select * from livre where num= :id");
            $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Livre');
            $req->bindParam(':id',$id);
            $req->execute();
            $leResultat=$req->fetch();
            return $leResultat;
        }


        /**
         * Ajout d'un livre
         *
         * @param Livre $livre livre à ajouter
         * @return integer resultat (1 si l'operation a reussi, 0 sinon)
         */
        public static function add(Livre $livre): int
        {
            $req=MonPdo::getInstance()->prepare("insert into livre(titre) values(:titre)");
            $titre=$livre->getTitre();
            $req->bindParam(':titre', $titre);
            $nb=$req->execute();
            return $nb;
        }



        /**
         * modifier un livre
         *
         * @param Livre $livre livre à modifier
         * @return integer resultat (1 si l'operation a reussi, 0 sinon)
         */
        public static function update(Livre $livre): int
        {
            $req=MonPdo::getInstance()->prepare("update livre set titre= :titre where num= :id");
            $num=$livre->getNum();
            $titre=$livre->getTitre();
            $req->bindParam(':id',$num);
            $req->bindParam(':titre',$titre);
            $nb=$req->execute();
            return $nb;
        }


        /**
         * Supprimer un livre
         *
         * @param Livre $livre
         * @return integer
         */
        public static function delete(Livre $livre) :int
        {
            $req=MonPdo::getInstance()->prepare("delete from livre where num= :id");
            $num=$livre->getNum();
            $req->bindParam(':id',$num);
            $nb=$req->execute();
            return $nb;
        }
        

        /**
         * Set numero du livre
         *@param int $num numero du livre
            * @return  self
            */ 
        public function setNum(int $num) :self
        {
                    $this->num = $num;

                    return $this;
        }



        // GETSETTER DU TITRE
        /**
         * Get titre du livre
         *
         * @return  string
         */ 
        public function getTitre() 
        {
                return $this->titre;
        }

        /**
         * Set titre du livre
         *
         * @param  string  $titre  titre du livre
         *
         * @return  self
         */ 
        public function setTitre(string $titre)
        {
                $this->titre = $titre;

                return $this;
        }










    }