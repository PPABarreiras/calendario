<?php

namespace Api\Controller;

use Api\Model\EntityStudent;
use Api\Model\EntityTeacher;
use Api\Session\User\SessionUser;
use Firebase\JWT\JWT;

class Auth
{
    /**
     * Método responsável por gerar um token JWT
     * @param Request $request
     * @return array
     */
    public static function generateToken($request)
    {
        // POST VARS
        $postVars = $request->getPostVars();

        //VALIDA OS CAMPOS OBRIGATÓRIOS REGISTRATION/SIAPE E PASSWORD
        if (!isset($postVars['registration']) && !isset($postVars['siape']) || !isset($postVars['password'])) {
            throw new \Exception("O campo 'password' é obrigatório!. É obrigatório um dos campos 'registration' ou 'siape' estarem preeenchidos!", 400);
        }

        // AUTENTICAÇÃO DO ALUNO
        if ($postVars['registration']) {

            // BUSCA UM ALUNO PELA MATRÍCULA
            $obUser = EntityStudent::getStudentByRegistration($postVars['registration']);

            //VALIDA SE O ALUNO EXISTE
            if (!$obUser instanceof EntityStudent) {
                throw new \Exception("Número registration ou password são inválidos", 400);
            }

            //VALIDA A SENHA DO ALUNO
            if (!password_verify($postVars['password'], $obUser->password)) {

                throw new \Exception("Número registration ou password são inválidos", 400);
            }

            // MATRÍCULA DO ALUNO
            $indice = "registration";
            $identify = $obUser->registration;

            // AUTENTICAÇÃO DO PROFESSOR
        } else if ($postVars['siape']) {

            // BUSCA UM PROFESSOR PELO SIAPE
            $obUser = EntityTeacher::getTeacherBySiape($postVars['siape']);

            //VALIDA SE O PROFESSOR EXISTE
            if (!$obUser instanceof EntityTeacher) {
                throw new \Exception("Número siape ou password são inválidos", 400);
            }

            //VALIDA A SENHA DO PROFESSOR
            if (!password_verify($postVars['password'], $obUser->password)) {

                throw new \Exception("Número siape ou password são inválidos", 400);
            }

            // IDENTIFICAÇÃO DO PROFESSOR
            $indice = "siape";
            $identify =  $obUser->siape;
        }

        // CRIA UM SESSÃO PARA O USUÁRIO
        SessionUser::createSession($obUser);

        // PAYLOAD
        $payload = [
            'name'   => $obUser->name,
            $indice  => $identify
        ];

        //RETORNA O TOKEN GERADO
        return [
            'token' => JWT::encode($payload, getenv('JWT_KEY')),
        ];
    }
}
