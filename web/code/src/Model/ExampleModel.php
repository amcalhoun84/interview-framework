<?php

declare(strict_types=1);

namespace Example\Model;

use Mini\Model\Model;

/**
 * Example data.
 */
class ExampleModel extends Model
{
    // This setup is less than ideal, while it's OOP and has members and methods, I would much prefer to use models
    // like this in Laravel and utilize eloquent and DB::RAW were necessary and appropriate.

    private int $id = 0;
    private string $code = '';
    private string $description = '';
    private string $created = '';   // not necessary, we just input now() as appropriate where we need to place it.

    // This is one way to do it -- there's also getters and setters, so we may want to talk about that.
    //public function __construct(?int $id, string $code = '', string $description = '', string $created = '')

    // we can declare it up-front OR we can use getters and setters, I like that way better -- above left in to show thought process
    public function __construct()
    {
        parent::__construct();
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setCreated(string $now): void
    {
        $this->created = $now;
    }

    public function getCreated(): string
    {
        return $this->created;
    }

    /**
     * Get example data by ID.
     *
     * @return array example data
     */
    public function getExample(): array
    {
        $sql = '
            SELECT
                example_id AS "id",
                created,
                code,
                description
            FROM
                ' . getenv('DB_SCHEMA') . '.master_example
            WHERE
                example_id = ?';

        return $this->db->select([
            'title' => 'Get example data',
            'sql' => $sql,
            'inputs' => [$this->id]
        ]);
    }

    /**
     * Create an example.
     *
     * @return int example id
     */
    public function createExample(): void
    {
        $sql = '
            INSERT INTO
                ' . getenv('DB_SCHEMA') . '.master_example
            (
                created,
                code,
                description
            )
            VALUES
            (?,?,?)';

        $id = $this->db->statement([
            'title' => 'Create example',
            'sql' => $sql,
            'inputs' => [
                $this->created,
                $this->code,
                $this->description
            ]
        ]);

        $this->db->validateAffected();

        $this->setId($id);
    }

    public function setExample(): int
    {
        // in more modern, thorough databases, we would have updated at, and we could update the updated at table, but
        // that's a bit beyond the scope of a quick refactor. Just a thought.

        $sql = '
            UPDATE
                ' . getenv('DB_SCHEMA') . '.master_example
            SET code = ?, 
                description = ?
            WHERE example_id = ?';

        // in the above, I'd have placed updated = ?

        $id = $this->db->statement([
            'title' => 'set example',
            'sql' => $sql,
            'inputs' => [
                $this->code,
                $this->description,
                $this->id,
                //now()
            ]
        ]);

        $this->db->validateAffected();

        return $id;
    }
}
