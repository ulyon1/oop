<?php

namespace Metinet\Repositories;

use Metinet\Domain\Members\Member;

interface MemberRepository
{
    public function save(Member $member): void;
    public function remove(Member $member): void;
    public function get(string $id): Member;
}
