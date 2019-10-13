<?php
class Usuario{

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    //---------Get and Set id----------------
    public function getIdusuario()
    {
        return $this->idusuario;
    }
    public function setIdusuario($value)
    {
        $this->idusuario = $value;
    }
    //---------Get and Set login--------------
    public function getDeslogin()
    {
        return $this->deslogin;
    }
    public function setDeslogin($value)
    {
        $this->deslogin = $value;
    }
    //-----------Get and Set senha--------------
    public function getDessenha()
    {
        return $this->dessenha;
    }
    public function setDessenha($value)
    {
        $this->dessenha = $value;
    }
    //------------Get and Set data--------------
    public function getDtcadastro()
    {
        return $this->dtcadastro;
    }
    public function setDtcadastro($value)
    {
        $this->dtcadastro = $value;
    }

    //***************************
    //seleciona usuario pelo ID *
    //***************************
    public function loadById($id){
        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$id
        ));
        if(count($results) > 0){
            $this->setData($results[0]);
        }
    }
    //***************************
    // Mostra todos os usuarios *
    //***************************
    public static function getList(){
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
    }
    public static function search($login){
        $sql= new Sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY  deslogin", array(
            ':SEARCH'=>"%".$login."%"
        ));
    }
    //----------------------------------
    public function login($login, $senha){

        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(
            ":LOGIN"=>$login,
            ":SENHA"=>$senha
        ));
        if(count($result) > 0){
            $this->setData($result[0]);
        }
        else{
            throw new Exception("Login ou Senha incorretos");
        }
    }
    //-------------
    public function setData($data){

        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro($data['dtcadastro']);
    }
    //-------------
    public function insert(){
        $sql = new Sql();

        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':SENHA'=>$this->getDessenha()
        ));
        if(count($results) > 0 ){
            $this->setData($results[0]);
        }
    }
    //-----------------
    public function update($login,$senha){
        $this->setDeslogin($login);
        $this->setDessenha($senha);
        $sql = new Sql();

        $sql->query("UPDATE tb_usuarios SET deslogin = :login ,dessenha = :senha WHERE idusuario = :id", array(
            ":login"=>$this->getDeslogin(),
            ":senha"=>$this->getDessenha(),
            ":id"=>$this->getIdusuario()

        ));
    }
    public function delete(){
        $sql = new Sql();
        $sql->query("DELETE FROM tb_usuarios WHERE idusuario = :id", array(
            ":id"=>$this->getIdusuario()
        ));
        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro(new DateTime());
    }
    //-----------------
    public function __construct($login = "", $senha = ""){
        $this->setDeslogin($login);
        $this->setDessenha($senha);
    }
    //-------------
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()
        ));
    }
}