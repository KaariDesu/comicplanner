<?php

declare(strict_types=1);

namespace ComicPlanner\Controller;

class Error404Controller 
{
    public function processaRequisicao(): void 
    {
        http_response_code(404);
    }
} ?>