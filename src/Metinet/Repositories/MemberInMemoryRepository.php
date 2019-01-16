<?php

namespace Metinet\Repositories;

use Metinet\Domain\Members\Member;

class MemberInMemoryRepository implements MemberRepository
{
    private $members = [];

    public function save(Member $member): void
    {
        $this->members[$member->getId()] = $member;
    }

    public function get(string $id): Member
    {
        if (!isset($this->members[$id])) {

            throw new MemberNotFound($id);
        }

        return $this->members[$id];
    }

    public function remove(Member $member): void
    {
        if (!isset($this->members[$member->getId()])) {

            throw new MemberNotFound($member->getId());
        }

        unset($this->members[$member->getId()]);
    }
}
