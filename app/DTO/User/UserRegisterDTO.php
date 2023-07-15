<?php

namespace App\DTO\User;

use App\DTO\BaseDTO\AbstractDTO;

class UserRegisterDTO extends AbstractDTO {
    /**
     * @var string|null
     */
    private ?string $email;

    /**
     * @var string|null
     */
    private ?string $email_verified_at;

    /**
     * @var string|null
     */
    private ?string $phone_verified_at;

    /**
     * @param string $name
     * @param string $password
     * @param string $user_type
     * @param string $phone
     */
    public function __construct(
        private string $name,
        private string $password,
        private string $user_type,
        private string $phone,
    ) {
    }

    public function setEmail(?string $email): self {
        $this->email = $email;

        return $this;
    }

    /**
     * @param string|null $email_verified_at
     * @return UserRegisterDTO
     */
    public function setEmailVerifiedAt(?string $email_verified_at): self {
        $this->email_verified_at = $email_verified_at;

        return $this;
    }

    /**
     * @param string|null $phone_verified_at
     * @return UserRegisterDTO
     */
    public function setPhoneVerifiedAt(?string $phone_verified_at): self {
        $this->phone_verified_at = $phone_verified_at;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string {
        return $this->phone;
    }

    /**
     * @return string|null
     */
    public function getEmailVerifiedAt(): ?string {
        return $this->email_verified_at;
    }

    /**
     * @return string|null
     */
    public function getPhoneVerifiedAt(): ?string {
        return $this->phone_verified_at;
    }

    /**
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getUserType(): string {
        return $this->user_type;
    }

    public static function fromArray(array $data): static {
        // TODO: Implement fromArray() method.
    }

    public function jsonSerialize(): array {
        return [];
    }
}
