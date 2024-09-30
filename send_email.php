<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os campos do formulário
    $subject = strip_tags(trim($_POST["subject"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Verificar se os dados estão completos
    if ( empty($subject) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Redirecionar com erro
        header("Location: contact.html?error=1");
        exit;
    }

    // Definir o email do destinatário
    $recipient = "projetohigibem@gmail.com"; // Substitua pelo seu email

    // Definir o assunto do email
    $email_subject = "Novo contato: $subject";

    // Construir o conteúdo do email
    $email_content = "Assunto: $subject\n";
    $email_content .= "Email do Remetente: $email\n\n";
    $email_content .= "Mensagem:\n$message\n";

    // Construir os cabeçalhos do email
    $email_headers = "From: $email";

    // Enviar o email
    if (mail($recipient, $email_subject, $email_content, $email_headers)) {
        // Redirecionar com sucesso
        header("Location: contact.html?success=1");
    } else {
        // Redirecionar com erro
        header("Location: contact.html?error=1");
    }

} else {
    // Não é uma requisição POST, redirecionar para o formulário de contato
    header("Location: contact.html");
}
?>
