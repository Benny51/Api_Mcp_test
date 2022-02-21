<?php

namespace Model;

use Infrastructure\Database;
use PDO;

class Tiers implements Model
{
    private $table_name = "tiers";
    //var for the db connexion
    private $db;
    //Column name of the db
    private $colPrimaryKey = "id";
    private $colCodeDossier = "code_dossier";
    private $colId_winbooks = "IdWinbooks";
    private $colClientMCP = "clientMCP";
    private $colNumTva = "numTva";
    private $colNumEntreprise = "NumEntreprise";
    private $colIsoc_Ipp = "isoc_ipp";
    private $colSociete = "societe";
    private $colPrenom = "prenom";
    private $colFormeJuridique = "formeJuridique";
    private $colDateCreation = "dateCreation";
    private $colArticle537 = "article537";
    private $colDateEntree = "dateEntree";
    private $colEmail = "email";
    private $colDevise = "devise";
    private $colDevise_2 = "devise_2";
    private $colTelelphone = "telephone";
    private $colMobile = "mobile";
    private $colFax = "fax";
    private $colCapitalSocial = "capitalSocial";
    private $colCapitalSocial_precedent = "capitalSocial_precedent";
    private $colTotal_actions_1 = "total_actions_1";
    private $colTotal_actions2 = "total_actions_2";
    private $colSiegeSoc_idSiege = "siegeSoc_IdSiege";
    private $colSiegeExp_IdSiege = "siegeExp_IdSiege";
    private $colManager_Id_intervenant = "manager_ID_Intervenant";
    private $colConsultant_ID_intervenant = "consultant_ID_Intervenant";
    private $colPartenaire_ID_intervenant = "partenaire_ID_Intervenant";
    private $colTypeCompta = "typeCompta";
    private $colEncodageCompta = "encodageCompta";
    private $colSuiviCompta = "suiviCompta";
    private $colFinExercice = "finExercice";
    private $colDebutExCompta = "debutExCompta";
    private $colDateAgoJour = "dateAgoJour";
    private $colDateAgoHeure = "dateAgoHeure";
    private $colNombrePart = "nombrePart";
    private $colFinExCompta = "finExCompta";
    private $colJourFerie = "jourFerie";
    private $colDeclarationPrProf = "declarationPrProf";
    private $colNace = "nace";
    private $colRegimeTva = "regimeTva";
    private $colDepotTva = "depotTva";
    private $colDepotIntracom = "depotIntracom";
    private $colDepotListing = "depotListing";
    private $colDepotReleveIntra = "depotReleveIntra";
    private $colActivite = "activite";
    private $colInfos = "infos";
    private $colDateArret = "dateArret";
    private $colModifArret = "modifArret";
    private $colDematbox = "dematBox";
    private $colStatut = "statut";
    private $colCreated_at = "created_at";
    private $colUpdated_at = "updated_at";
    private $colGestion_compta = "gestion_compta";
    private $colNissIPP = "nissIPP";
    private $colNissIPPDateExpire = "nissIPPDateExpire";
    private $colIPPBirdDate = "IPPbirdDate";
    private $colRegie = "regie";
    private $colAncienComptable = "ancienComptable";
    private $colNote = "note";
    private $colCptBanque = "cptBanque";
    private $colStatutLegal = "statutLegal";
    private $colEmailDepot = "email_depot";
    private $colEnvoi_depot = "envoi_depot";
    private $colActions = "actions";

    public function __construct()
    {
        $this->db = new Database();
    }

    public function create()
    {
        $collumns = "$this->colCodeDossier,$this->colId_winbooks,$this->colClientMCP,$this->colNumTva,$this->colNumEntreprise,
        $this->colIsoc_Ipp,$this->colSociete,$this->colPrenom,$this->colFormeJuridique,$this->colDateCreation,$this->colArticle537,
        $this->colDateEntree,$this->colEmail,$this->colDevise,$this->colDevise_2,$this->colTelelphone,$this->colMobile,$this->colFax,
        $this->colCapitalSocial,$this->colCapitalSocial_precedent,$this->colTotal_actions_1,$this->colTotal_actions2,$this->colSiegeSoc_idSiege,
        $this->colSiegeExp_IdSiege,$this->colManager_Id_intervenant,$this->colConsultant_ID_intervenant,$this->colPartenaire_ID_intervenant,
        $this->colTypeCompta,$this->colEncodageCompta,$this->colSuiviCompta,$this->colFinExercice,$this->colDebutExCompta,$this->colDateAgoJour,
        $this->colDateAgoHeure,$this->colNombrePart,$this->colFinExCompta,$this->colJourFerie,$this->colDeclarationPrProf,$this->colNace,
        $this->colRegimeTva,$this->colDepotTva,$this->colDepotIntracom,$this->colDepotListing,$this->colDepotReleveIntra,$this->colActivite,
        $this->colInfos,$this->colDateArret,$this->colModifArret,$this->colDematbox,$this->colStatut,$this->colCreated_at,$this->colUpdated_at,
        $this->colGestion_compta,$this->colNissIPP,$this->colNissIPPDateExpire,$this->colIPPBirdDate,$this->colRegie,$this->colAncienComptable,
        $this->colNote,$this->colCptBanque,$this->colStatutLegal,$this->colEmailDepot,$this->colEnvoi_depot,$this->colActions";

        $params = ":colCodeDossier,:colId_winbooks,:colClientMCP,:colNumTva,:colNumEntreprise,
        :colIsoc_Ipp,:colSociete,:colPrenom,:colFormeJuridique,:colDateCreation,:colArticle537,
        :colDateEntree,:colEmail,:colDevise,:colDevise_2,:colTelelphone,:colMobile,:colFax,
        :colCapitalSocial,:colCapitalSocial_precedent,:colTotal_actions_1,:colTotal_actions2,:colSiegeSoc_idSiege,
        :colSiegeExp_IdSiege,:colManager_Id_intervenant,:colConsultant_ID_intervenant,:colPartenaire_ID_intervenant,
        :colTypeCompta,:colEncodageCompta,:colSuiviCompta,:colFinExercice,:colDebutExCompta,:colDateAgoJour,
        :colDateAgoHeure,:colNombrePart,:colFinExCompta,:colJourFerie,:colDeclarationPrProf,:colNace,
        :colRegimeTva,:colDepotTva,:colDepotIntracom,:colDepotListing,:colDepotReleveIntra,:colActivite,
        :colInfos,:colDateArret,:colModifArret,:colDematbox,:colStatut,:colCreated_at,:colUpdated_at,
        :colGestion_compta,:colNissIPP,:colNissIPPDateExpire,:colIPPBirdDate,:colRegie,:colAncienComptable,
        :colNote,:colCptBanque,:colStatutLegal,:colEmailDepot,:colEnvoi_depot,:colActions";


        $sqlQuery = "INSERT INTO $this->table_name ($collumns) values($params)";
        $pdoStatement = $this->db->getBddConnect()->prepare($sqlQuery);

        $pdoStatement->bindParam(":colCodeDossier",$_POST['code_dossier']);
        $pdoStatement->bindParam(":colId_winbooks",$_POST['Id_winbooks']);
        $pdoStatement->bindParam(":colClientMCP",$_POST['clientMCP']);
        $pdoStatement->bindParam(":colNumTva",$_POST['numTva']);
        $pdoStatement->bindParam(":colNumEntreprise",$_POST['numEntreprise']);
        $pdoStatement->bindParam(":colIsoc_Ipp",$_POST['isoc_ipp']);
        $pdoStatement->bindParam(":colSociete",$_POST['societe']);
        $pdoStatement->bindParam(":colPrenom",$_POST['prenom']);
        $pdoStatement->bindParam(":colFormeJuridique",$_POST['formeJuridique']);
        $pdoStatement->bindParam(":colDateCreation",$_POST['date_creation']);
        $pdoStatement->bindParam(":colArticle537",$_POST['article537']);
        $pdoStatement->bindParam(":colDateEntree",$_POST['date_entree']);
        $pdoStatement->bindParam(":colEmail",$_POST['email']);
        $pdoStatement->bindParam(":colDevise",$_POST['devise']);
        $pdoStatement->bindParam(":colDevise_2",$_POST['devise_2']);
        $pdoStatement->bindParam(":colTelelphone",$_POST['telephone']);
        $pdoStatement->bindParam(":colMobile",$_POST['mobile']);
        $pdoStatement->bindParam(":colFax",$_POST['fax']);
        $pdoStatement->bindParam(":colCapitalSocial",$_POST['capitalSocial']);
        $pdoStatement->bindParam(":colCapitalSocial_precedent",$_POST['capitalSocial_precedent']);
        $pdoStatement->bindParam(":colTotal_actions_1",$_POST['total_actions_1']);
        $pdoStatement->bindParam(":colTotal_actions_2",$_POST['total_actions_2']);
        $pdoStatement->bindParam(":colSiegeSoc_idSiege",$_POST['siegeSoc_idSiege']);
        $pdoStatement->bindParam(":colSiegeExp_IdSiege",$_POST['siegeExp_IdSiege']);
        $pdoStatement->bindParam(":colManager_Id_intervenant",$_POST['manager_Id_intervenant']);
        $pdoStatement->bindParam(":colConsultant_ID_intervenant",$_POST['consultant_ID_intervenant']);
        $pdoStatement->bindParam(":colPartenaire_ID_intervenant",$_POST['partenaire_ID_intervenant']);
        $pdoStatement->bindParam(":colTypeCompta",$_POST['typeCompta']);
        $pdoStatement->bindParam(":colEncodageCompta",$_POST['encodageCompta']);
        $pdoStatement->bindParam(":colSuiviCompta",$_POST['suiviCompta']);
        $pdoStatement->bindParam(":colFinExercice",$_POST['finExercice']);
        $pdoStatement->bindParam(":colDebutExCompta",$_POST['debutExCompta']);
        $pdoStatement->bindParam(":colDateAgoJour",$_POST['dateAgoJour']);
        $pdoStatement->bindParam(":colDateAgoHeure",$_POST['dateAgoHeure']);
        $pdoStatement->bindParam(":colNombrePart",$_POST['nombrePart']);
        $pdoStatement->bindParam(":colFinExCompta",$_POST['finExCompta']);
        $pdoStatement->bindParam(":colJourFerie",$_POST['jourFerie']);
        $pdoStatement->bindParam(":colDeclarationPrProf",$_POST['declarationPrProf']);
        $pdoStatement->bindParam(":colNace",$_POST['nace']);
        $pdoStatement->bindParam(":colRegimeTva",$_POST['regimeTva']);
        $pdoStatement->bindParam(":colDepotTva",$_POST['depotTva']);
        $pdoStatement->bindParam(":colDepotIntracom",$_POST['depotIntracom']);
        $pdoStatement->bindParam(":colDepotListing",$_POST['depotListing']);
        $pdoStatement->bindParam(":colDepotReleveIntra",$_POST['depotReleveIntra']);
        $pdoStatement->bindParam(":colActivite",$_POST['activite']);
        $pdoStatement->bindParam(":colInfos",$_POST['infos']);
        $pdoStatement->bindParam(":colDateArret",$_POST['dateArret']);
        $pdoStatement->bindParam(":colModifArret",$_POST['modifArret']);
        $pdoStatement->bindParam(":colDematbox",$_POST['dematbox']);
        $pdoStatement->bindParam(":colStatut",$_POST['statut']);
        $pdoStatement->bindParam(":colCreated_at",$_POST['created_at']);
        $pdoStatement->bindParam(":colUpdated_at",$_POST['updated_at']);
        $pdoStatement->bindParam(":colGestion_compta",$_POST['gestion_compta']);
        $pdoStatement->bindParam(":colNissIPP",$_POST['nissIPP']);
        $pdoStatement->bindParam(":colNissIPPDateExpire",$_POST['nissIPPDateExpire']);
        $pdoStatement->bindParam(":colIPPBirdDate",$_POST['IPPBirdDate']);
        $pdoStatement->bindParam(":colRegie",$_POST['regie']);
        $pdoStatement->bindParam(":colAncienComptable",$_POST['ancienComptable']);
        $pdoStatement->bindParam(":colNote",$_POST['note']);
        $pdoStatement->bindParam(":colCptBanque",$_POST['cptBanque']);
        $pdoStatement->bindParam(":colStatutLegal",$_POST['statutLegal']);
        $pdoStatement->bindParam(":colEmailDepot",$_POST['emailDepot']);
        $pdoStatement->bindParam(":colEnvoi_depot",$_POST['envoi_depot']);
        $pdoStatement->bindParam(":colActions",$_POST['actions']);

        return $pdoStatement;
    }

    public function getAll()
    {
        //Si jamais une condition ISOC ou IPP a été sélectionné
        if(isset($_POST['cond']))
        {
            $sqlQuery = "SELECT * from $this->table_name where $this->colIsoc_Ipp = :isoc_ipp";
            $pdostatement = $this->db->getBddConnect()->prepare($sqlQuery);
            $pdostatement->bindParam(":isoc_ipp",$_POST['cond']);
            $pdostatement->execute();

            return $pdostatement;
        }
        //Sinon on renvoie tout les tiers
        $sqlQuery = "SELECT * FROM $this->table_name";
        return $this->db->getBddConnect()->query($sqlQuery);
    }

    public function getTierById($id)
    {
        $sqlQuery = "SELECT * FROM $this->table_name where $this->colId_winbooks = :id";
        $pdoStatement = $this->db->getBddConnect()->prepare($sqlQuery);
        $pdoStatement->bindParam(":id",$id);
        $pdoStatement->execute();

        return $pdoStatement;
    }

    public function getMCPTiers()
    {
        $sqlQuery = "SELECT * FROM $this->table_name where substring($this->colId_winbooks,1,3) = 'MCP' ";
        return $this->db->getBddConnect()->query($sqlQuery);
    }


    public function update($id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        $sqlQuery = "DELETE FROM $this->table_name where $this->colId_winbooks = :id";
        $pdostatement = $this->db->getBddConnect()->prepare($sqlQuery);
        $pdostatement->bindParam(":id",$id);
        return $pdostatement->execute();
    }
}