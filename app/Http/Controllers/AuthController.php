<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display the login page.
     */
    public function login()
    {
        return view('auth.login');
    }

    public function loginSubmit(Request $request)
    {
        // validacão dos dados do formulário
        $request->validate(
            [
                'email' => 'required|email',
                // validacão da senha com regex para atender aos requisitos de segurança 
                // A senha deve conter pelo menos 8 caracteres, incluindo uma letra maiúscula, uma letra minúscula, um número e um caractere especial
                'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            ],
            [
                'email.required' => 'O campo de e-mail é obrigatório.',
                'email.email' => 'O campo de e-mail deve ser um endereço de e-mail válido.',
                'password.required' => 'O campo de senha é obrigatório.',
                'password.regex' => 'A senha deve conter pelo menos 8 caracteres, incluindo uma letra maiúscula, uma letra minúscula, um número e um caractere especial.',
            ]
        );

        // autenticação do usuário usando o email e a senha fornecidos
        $user = User::where('email', trim($request->email))
            ->where('active', true)
            ->whereNull('deleted_at')
            ->where(function ($query) {
                $query->whereNull('blocked_until')
                    ->orWhere('blocked_until', '<', now());
            })->first();

        // checar se o usuário existe e se a senha está correta
        if ($user && Hash::check($request->password, $user->password)) {
            // logar o usuário
            $this->loginUser($user);

            // redirecionar para a página inicial
            return redirect()->route('home');
        } else {
            // se a autenticação falhar, redirecionar de volta para a página de login com uma mensagem de erro
            return redirect()->back()
                ->withInput()
                ->with('server_error', 'Credenciais inválidas.');
        }
    }

    public function logout(Request $request)
    {
        // lógica para deslogar o usuário
        Auth::logout();

        // limpar a sessão do usuário
        session()->invalidate();

        // regenerar o token CSRF para evitar ataques de falsificação de solicitação entre sites
        session()->regenerateToken();

        return redirect()->route('login');
    }

    public function changePassword()
    {
        return view('auth.change-password');
    }

    public function changePasswordSubmit(Request $request)
    {
        // validação dos dados do formulário
        $request->validate([
            'current_password' => 'required',
            // A senha deve conter pelo menos 8 caracteres, incluindo uma letra maiúscula, uma letra minúscula, um número e um caractere especial
            'new_password' => 'required|confirmed||min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        ], [
            'current_password.required' => 'O campo de senha atual é obrigatório.',
            'new_password.required' => 'O campo de nova senha é obrigatório.',
            'new_password.confirmed' => 'A confirmação da nova senha não corresponde.',
            'new_password.min' => 'A nova senha deve ter pelo menos 8 caracteres.',
            'new_password.regex' => 'A nova senha deve conter pelo menos 8 caracteres, incluindo uma letra maiúscula, uma letra minúscula, um número e um caractere especial.',
        ]);

        $user = User::findOrFail(Auth::id());

        // checar se a senha atual está correta
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'A senha atual está incorreta.']);
        }

        // atualizar a senha do usuário
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('home')->with('success', 'Senha alterada com sucesso.');
    }

    public function loginUser(User $user)
    {
        // atualizar ultimo login do usuário
        $user->last_login = now();
        $user->code = null;
        $user->code_expires_at = null;
        $user->blocked_until = null;
        $user->save();

        // autenticar o usuário
        Auth::login($user);
    }
}
