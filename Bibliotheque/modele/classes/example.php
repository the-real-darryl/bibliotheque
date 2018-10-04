$this->db->beginTransaction();

try {

    $queryOne->execute();
    $queryTwo->execute();

    $this->db->commit();

} catch (\Exception $e) {
    $this->db->rollback();
    throw $e;
}