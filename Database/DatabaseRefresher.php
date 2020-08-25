<?php

namespace ruano_a\ReloadAnnotationBundle\Database;

class DatabaseRefresh
{
    public static function refresh(): void
    {
        // TODO make something better
        shell_exec('php bin/console doctrine:schema:drop --env=test --force --quiet'.
                '&& php bin/console doctrine:schema:update --env=test --force --quiet'.
                '&& php bin/console doctrine:fixtures:load --env=test --no-interaction --quiet'); 
    }
}