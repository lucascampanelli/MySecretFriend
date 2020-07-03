<?php

    namespace Source\Models;
    
    use Exception;
    use stdClass;
    use PHPMailer\PHPMailer\PHPMailer;

    class Email{
        private $mail;
        private $data;
        private $error;

        public function __construct(){
            $this->mail = new PHPMailer();
            $this->data = new stdClass();

            $this->mail->isSMTP();
            $this->mail->isHTML();
            $this->mail->setLanguage("br");
            $this->mail->SMTPAuth = true;
            $this->mail->SMTPSecure = "tls";
            $this->mail->CharSet = "utf-8";

            $this->mail->Host = SMTP_MAIL_CONFIG["host"];
            $this->mail->Port = SMTP_MAIL_CONFIG["port"];
            $this->mail->Username = SMTP_MAIL_CONFIG["user"];
            $this->mail->Password = SMTP_MAIL_CONFIG["passwd"];
        }

        public function createEmail(string $subject, string $body, string $recipient_name, string $recipient_email) : Email{
            $this->data->subject = $subject;
            $this->data->body = $body;
            $this->data->recipient_name = $recipient_name;
            $this->data->recipient_email = $recipient_email;

            return $this;
        }

        public function attach(string $filePath, string $fileName): Email{
            $this->data->attach[$filePath] = $fileName;
        }

        public function sendEmail(string $from_name = SMTP_MAIL_CONFIG["from_name"], string $from_email = SMTP_MAIL_CONFIG["from_email"]):bool{
            try{
                $this->mail->Subject = $this->data->subject;
                $this->mail->msgHTML($this->data->body);
                $this->mail->addAddress($this->data->recipient_email, $this->data->recipient_name);
                $this->mail->setFrom($from_email, $from_name);

                if(!empty($this->data->attach)){
                    foreach($this->data->attach as $path => $name){
                        $this->mail->addAtachment($path, $name);
                    }
                }

                $this->mail->send();

                return true;
            }
            catch(Exception $e){
                $this->error = $e;
                return false;
            }
        }

        public function error(): ?Exception{
            return $this->error;
        }

    }