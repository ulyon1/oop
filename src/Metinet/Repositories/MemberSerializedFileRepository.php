<?php

namespace Metinet\Repositories;

use Metinet\Core\Security\Account;
use Metinet\Core\Security\AccountNotFound;
use Metinet\Core\Security\AccountProvider;
use Metinet\Domain\Email;
use Metinet\Domain\Members\Member;

class MemberSerializedFileRepository implements MemberRepository, AccountProvider
{
    private $path;
    /**
     * @var Member[]
     */
    private $members = [];

    public function __construct(string $path)
    {
        $this->path = $path;
        $this->members = unserialize(file_get_contents($this->path));
    }

    public function save(Member $member): void
    {
        $this->members[$member->getId()] = $member;
        $this->persist();
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
        $this->persist();
    }

    public function findByUsername(string $username): Account
    {
        foreach ($this->members as $member) {

            if ($member->getEmail()->equals(new Email($username))) {

                return $member;
            }
        }

        throw new AccountNotFound($username);
    }

    private function persist(): void
    {
        if (file_put_contents($this->path, serialize($this->members)) < 1) {

            throw new \RuntimeException('Unable to persist member repository data');
        }
    }
}
