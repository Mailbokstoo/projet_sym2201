<?php 

namespace App\Event;
use Symfony\Contracts\EventDispatcher\Event;

class BeforeShowPostsEvent extends Event
{
    public function __construct(
       
    ) {
    }

    public function showPosts(): string
    {
        $libelle = "je passe par là";
        return $libelle;
    }

    
}