<?php
class Role{
    public function AddRole($role_name)
    {
        $query = new Database();
        return $query->insert("roles", array('role_name' => $role_name ));
    }

    public function GetActiveRoles()
    {
        $query = new Database();
        return $query->get("roles","role_name", array('role_status','=','1'));
    }

    public function DeactivateRole($role_id)
    {
        $query = new Database();
        return $query->update("roles", "id", $role_id, array('role_status' => '0'));
    }

    public function ReactivateRole($role_id)
    {
        $query = new Database();
        return $query->update("roles", "id", $role_id, array('role_status' => '1'));
    }

    public function DeleteRole($role_id)
    {
        $query = new Database();
      return $query->delete("roles",$role_id);
    }
}