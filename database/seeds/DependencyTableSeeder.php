<?php

use Illuminate\Database\Seeder;

class DependencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipodocs = [
            'ATA', 'ATESTADO', 'AVISO', 'CARTA', 'CONVITE', 'DECRETO', 'DECRETO-LEI', 'DESPACHO', 'LEI', 'MEMORANDO',
            'MEMORANDO CIRCULAR', 'OFÍCIO', 'OFÍCIO CIRCULAR', 'ORDEM DE SERVIÇO', 'PORTARIA', 'REQUERIMENTO'
        ];

        $this->command->info('Criando Tipo de Documentos');

        foreach ($tipodocs as $tipodoc) {
            \App\Domains\Protocolo\Models\TipoDocumento::create(['descricao' => $tipodoc]);
        }

        $secretarias = [
            'Gabinete do Prefeito - GAB/PREF.', 'Procuradoria Geral do Município - PGM', 'Secretaria Municipal de Planejamento Orçamento e Gestão - SEMPOG',
            'SEMPOG /SEMPLA', 'SEMPOG /SUBSECRETARIA SEMPRE', 'Secretaria Municipal de Fazenda - SEMFAZ', 'Secretaria Municipal de Administração - SEMAD',
            'Secretaria Municipal de Saúde - SEMUSA', 'Secretaria Municipal de Educação - SEMED',
            'Secretaria Municipal de Infraestrutura Urbana e Serviços Básicos - SEMISB', 'SEMISB / SUBSECRETARIA SEMOB',
            'SEMISB /SUBSECRETARIA SEMUSB', 'Secretaria Municipal de Assistência Social e da Família - SEMASF',
            'Secretaria Municipal de Esporte e Lazer - SEMES', 'Secretaria Municipal de Integração - SEMI', 'SEMI /SUBSECRETARIA SEMA',
            'SEMI /SUBSECRETARIA SEMDESTUR', 'SEMI/SUBSECRETARIA SEMAGRIC', 'Secretaria Municipal de Desenvolvimento Fundiário, Habitação e Urbanismo - SEMUR',
            'Fundação Cultural do Município de Porto Velho - FUNCULTURAL', 'Empresa Municipal de Desenvolvimento Urbano - EMDUR',
            'Instituto de Previd. e Assist. dos Servidores do Município de Porto Velho - IPAM', 'Secretaria Municipal de Trânsito, Mobilidade e Transporte - SEMTRAN',
            'Controladoria Geral do Município - CGM', 'Prefeitura Municipal de Porto Velho - PMPV'
        ];

        $this->command->info('Criando Secretarias');

        foreach ($secretarias as $secretaria) {
            \App\Domains\Protocolo\Models\Secretarias::create(['descricao' => $secretaria]);
        }

        $departamentos = [
            'DCS','DEA','ASTEC','GABINETE','GABINETE ADJ'
        ];

        $this->command->info('Criando Departamentos');

        foreach ($departamentos as $departamento) {
            \App\Domains\Protocolo\Models\Departamento::create(['descricao' => $departamento]);
        }

    }
}
