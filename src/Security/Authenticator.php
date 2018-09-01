<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\SimpleFormAuthenticatorInterface;

class Authenticator implements SimpleFormAuthenticatorInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        try {
            $user = $userProvider->loadUserByUsername($token->getUsername());
        } catch (UsernameNotFoundException $e) {
            throw new CustomUserMessageAuthenticationException("invalid username ot password");
        }

        $currentUser = $token->getUser();

        if ($currentUser instanceof UserInterface) {
            if ($currentUser->getPassword() !== $user->getPassword()) {
                throw new BadCredentialsException('The credentials were changed from another session.');
            }
        } else {
            if ('' === ($givenPassword = $token->getCredentials())) {
                throw new BadCredentialsException('The given password cannot be empty.');
            }
            if (!$this->encoder->encodePassword($user, $givenPassword)) {
                throw new BadCredentialsException('The given password is invalid.');
            }
        }

        $isPasswordValid = $this->encoder->isPasswordValid($user, $token->getCredentials());
        if ($isPasswordValid) {
            return new UsernamePasswordToken($user, $user->getPassword(), $providerKey, $user->getRoles());
        }

        throw new CustomUserMessageAuthenticationException('Invalid username or password');

    }

    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof UsernamePasswordToken
            && $token->getProviderKey() == $providerKey;
    }

    public function createToken(Request $request, $username, $password, $providerKey)
    {
        return new UsernamePasswordToken($username, $password, $providerKey);
    }
}