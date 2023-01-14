<?php 
namespace App\Repositories;

use App\AppData;
use App\Models\RegistrationCredential;

class RegistrationCredentialRepository{
  public function getAllDataRegistrationCredentialPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE)
  {
    return RegistrationCredential::with("role")
      ->select($columns)
      ->paginate($perPage);
  }


  public function addNewDataRegistrationCredential(array $requestedData):?object
  {
    return RegistrationCredential::create($requestedData);
  }

  public function deleteDataRegistrationCredentialById(int $id)
  {
    return RegistrationCredential::destroy($id);
  }

  public function getDataRegistrationCredentialByCredential(string $credential)
  {
    return RegistrationCredential::where([
      "credential" => $credential,
      "is_active" => true
    ])->first();
  }

  public function updateDataRegistrationCredentialById(int $id, array $requestedData)
  {
    return RegistrationCredential::where("id", $id)->update($requestedData);
  }
}

?>