<?php

use Phinx\Migration\AbstractMigration;

class FixActivateCodeType extends AbstractMigration
{
    public function up()
    {
        // Change activate_code from INT to VARCHAR(60)
        // using execute() for raw SQL as typical alter table
        $this->execute("ALTER TABLE unibooker MODIFY COLUMN activate_code VARCHAR(60)");
    }

    public function down()
    {
        // Revert back to INT if needed (though data loss might occur if non-integers exist)
        $this->execute("ALTER TABLE unibooker MODIFY COLUMN activate_code INT");
    }
}
