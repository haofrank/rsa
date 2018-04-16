<?php

namespace HaoFrank\Rsa\Console;

use HaoFrank\Rsa\RSA;
use Illuminate\Console\Command;

class KeysCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RSA:keys {--force : Overwrite keys they already exist}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the encryption keys';

    /**
     * Execute the console command.
     *
     * @param  \HaoFrank\Rsa\RSA  $rsa
     * @return mixed
     */
    public function handle(RSA $rsa)
    {
        list($publicKey, $privateKey) = [
            Passport::keyPath('oauth-public.key'),
            Passport::keyPath('oauth-private.key'),
        ];

        if ((file_exists($publicKey) || file_exists($privateKey)) && ! $this->option('force')) {
            return $this->error('Encryption keys already exist. Use the --force option to overwrite them.');
        }

        $keys = $rsa->createKey(4096);

        file_put_contents($publicKey, array_get($keys, 'publickey'));
        file_put_contents($privateKey, array_get($keys, 'privatekey'));

        $this->info('Encryption keys generated successfully.');
    }
}
