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
         * Langue du livre
         * @var string
         */
        private $langue;

        /**
         * nom de l'auteur #gettersetter
         * @var string
         */
        private $auteur;

        /**
         * genre du livre #gettersetter
         * @var string
         */
        private $genre;


        /**
         * Summary of numAuteur
         * @var int
         */
        private $numAuteur;
        /**
         * Summary of numGenre
         * @var int
         */
        private $numGenre;


        
        
        
        //////// LES FONCTIONS  //////  
        
        /**
         * retourne l'ensemble des livres
         *
         * @return Livre[] tab d'objet livre
         */
        public static function findAll() :array
        {
            $req=MonPdo::getInstance()->prepare("Select livre.* , auteur.nom as nomauteur, genre.libelle as nomgenre from livre 
            join genre on livre.numGenre=genre.num join auteur on livre.numAuteur=auteur.num order by livre.num");
            $req->setFetchMode(PDO::FETCH_OBJ);
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
            $req=MonPdo::getInstance()->prepare("Select * from livre where num= :num");
            $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Livre');
            $req->bindParam(':num',$id);
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
            $req=MonPdo::getInstance()->prepare("insert into livre(isbn,titre,prix,editeur,annee,langue,numauteur,numgenre) 
            values(:isbn,:titre,:prix,:editeur,:annee,:langue,:numauteur,:numgenre)");
            $req->bindParam(':isbn', $livre->isbn);
            $req->bindParam(':titre', $livre->titre);
            $req->bindParam(':prix', $livre->prix);
            $req->bindParam(':editeur', $livre->editeur);
            $req->bindParam(':annee', $livre->annee);
            $req->bindParam(':langue', $livre->langue);
            $req->bindParam(':numauteur', $livre->auteur);
            $req->bindParam(':numgenre', $livre->genre);
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
            $req=MonPdo::getInstance()->prepare("update livre set isbn=:isbn, titre= :titre, prix=:prix,
            editeur=:editeur, annee=:annee, langue=:langue, numauteur=:numauteur, numgenre=:numgenre");

            $req->bindParam(':isbn', $livre->isbn);
            $req->bindParam(':titre', $livre->titre);
            $req->bindParam(':prix', $livre->prix);
            $req->bindParam(':editeur', $livre->editeur);
            $req->bindParam(':annee', $livre->annee);
            $req->bindParam(':langue', $livre->langue);
            $req->bindParam(':numauteur', $livre->auteur);
            $req->bindParam(':numgenre', $livre->genre);
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
        
        
        /////                 GETTERS ET SETTERS                              /////


        //GETSETTER DU NUM
        /**
         * Get the value of num
         */ 
        public function getNum()
        {
            return $this->num;
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
        
        



        //GETSETTER ISBN
        /**
         * Get identifiant Isbn #gettersetter
         *
         * @return  string
         */ 
        public function getIsbn()
        {
                return $this->isbn;
        }
        /**
         * Set identifiant Isbn #gettersetter
         *
         * @param  string  $isbn  identifiant Isbn #gettersetter
         *
         * @return  self
         */ 
        public function setIsbn(string $isbn)
        {
                $this->isbn = $isbn;

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



        //GETSETTER DU PRIX
        /**
         * Get undocumented function #gettersetter
         */ 
        public function getPrix()
        {
                return $this->prix;
        }

        /**
         * Set undocumented function #gettersetter
         *
         * @return  self
         */ 
        public function setPrix($prix)
        {
                $this->prix = $prix;

                return $this;
        }



        //GETSETTER DE L'EDITEUR
        /**
         * Get nom de l' editeur #gettersetter
         *
         * @return  string
         */ 
        public function getEditeur()
        {
                return $this->editeur;
        }
        /**
         * Set nom de l' editeur #gettersetter
         *
         * @param  string  $editeur  nom de l' editeur #gettersetter
         *
         * @return  self
         */ 
        public function setEditeur(string $editeur)
        {
                $this->editeur = $editeur;

                return $this;
        }



        //GETSETTER DE L'ANNEE
        /**
         * Get année de parution #gettersetter
         *
         * @return  int;
         */ 
        public function getAnnee()
        {
                return $this->annee;
        }
        /**
         * Set année de parution #gettersetter
         *
         * @param  int;  $annee  Année de parution #gettersetter
         *
         * @return  self
         */ 
        public function setAnnee(int $annee)
        {
                $this->annee = $annee;

                return $this;
        }



        //GETSETTER DES LANGUES
        /**
         * Get langue du livre
         *
         * @return  string
         */ 
        public function getLangue()
        {
                return $this->langue;
        }
        /**
         * Set langue du livre
         *
         * @param  string  $langue  Langue du livre
         *
         * @return  self
         */ 
        public function setLangue(string $langue)
        {
                $this->langue = $langue;

                return $this;
        }




        //GETSETTER DES AUTEURS
        /**
         * Get nom de l'auteur #gettersetter
         *
         * @return string
         */ 
        public function getAuteur()
        {
                return $this->auteur;
        }
        /**
         * Set nom de l'auteur #gettersetter
         *
         * @param  string  $numauteur  nom de l'auteur #gettersetter
         *
         * @return  self
         */ 
        public function setAuteur(string $auteur)
        {
                $this->auteur = $auteur;

                return $this;
        }

        /**
         * Get the value of numAuteur
         */ 
        public function getNumAuteur()
        {
                return Auteur::findById($this->numAuteur);
                 
        }

        /**
         * Set the value of numAuteur
         *
         * @return  self
         */ 
        public function setNumAuteur($numAuteur)
        {
                $this->numAuteur = $numAuteur->getNum();

                return $this;
        }

        //GETSETTER DES GENRES
        /**
         * Get genre du livre #gettersetter
         *
         * @return string
         */ 
        public function getGenre()
        {
                return $this->genre;
        }
        /**
         * Set genre du livre #gettersetter
         *
         * @param string $genre  genre du livre #gettersetter
         *
         * @return  self
         */ 
        public function setGenre(string $genre)
        {
                $this->genre = $genre;
                return $this;
        }

        

        /**
         * Get the value of numGenre
         */ 
        public function getNumGenre()
        {
                return Genre::findById($this->numGenre);
        }

        /**
         * Set the value of numGenre
         *
         * @return  self
         */ 
        public function setNumGenre($numGenre)
        {
                $this->numGenre = $numGenre->getNum();

                return $this;
        }
    }