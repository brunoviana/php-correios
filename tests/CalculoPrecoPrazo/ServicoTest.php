<?php

namespace BrunoViana\Correios\Tests\CalculoPrecoPrazo;

use BrunoViana\Correios\Tests\TestCase;
use BrunoViana\Correios\CalculoPrecoPrazo\Servico;

class ServicoTest extends TestCase
{
    public function test_Deve_Retornar_Todos_Os_Servicos()
    {
        $servicos = Servico::todos();

        $this->assertEquals(count(Servico::NOMES_SERVICOS), count($servicos));
        $this->assertEquals(array_keys(Servico::NOMES_SERVICOS), $servicos);
    }

    public function test_Retornar_Nome_Completo_Dos_Servicos()
    {
        $this->assertEquals('PAC 41068', Servico::nomeCompleto(
            Servico::PAC_41068
        ));

        $this->assertEquals('PAC 04510', Servico::nomeCompleto(
            Servico::PAC_04510
        ));

        $this->assertEquals('PAC Grandes Formatos 41300', Servico::nomeCompleto(
            Servico::PAC_41300
        ));

        $this->assertEquals('E-Sedex Standard 81019', Servico::nomeCompleto(
            Servico::ESEDEX_81019
        ));

        $this->assertEquals('Sedex 40096', Servico::nomeCompleto(
            Servico::SEDEX_40096
        ));

        $this->assertEquals('Sedex 40436', Servico::nomeCompleto(
            Servico::SEDEX_40436
        ));

        $this->assertEquals('Sedex 40444', Servico::nomeCompleto(
            Servico::SEDEX_40444
        ));

        $this->assertEquals('Sedex 12 40169', Servico::nomeCompleto(
            Servico::SEDEX_40169
        ));

        $this->assertEquals('Sedex 10 40215', Servico::nomeCompleto(
            Servico::SEDEX_40215
        ));

        $this->assertEquals('Sedex à vista 04014', Servico::nomeCompleto(
            Servico::SEDEX_04014
        ));

        $this->assertEquals('Sedex 10 Pacote 40886', Servico::nomeCompleto(
            Servico::SEDEX10_40886
        ));

        $this->assertEquals('Sedex Hoje 40290', Servico::nomeCompleto(
            Servico::SEDEX_HOJE_40290
        ));

        $this->assertEquals('Sedex Hoje 40878', Servico::nomeCompleto(
            Servico::SEDEX_HOJE_40878
        ));

        $this->assertEquals('Sedex Varejo à Cobrar 40045', Servico::nomeCompleto(
            Servico::SEDEX_VAREJO_A_COBRAR_40045
        ));

        $this->assertEquals('Sedex Agrupado 41009', Servico::nomeCompleto(
            Servico::SEDEX_AGRUPADO_41009
        ));

        $this->assertEquals('Sedex Reverso 40380', Servico::nomeCompleto(
            Servico::SEDEX_REVERSO_40380
        ));

        $this->assertEquals('Sedex Pagamento na Entrega 40630', Servico::nomeCompleto(
            Servico::SEDEX_PAGAMENTO_NA_ENTREGA_40630
        ));

        $this->assertEquals('Carta Comercial a Faturar 10065', Servico::nomeCompleto(
            Servico::CARTA_COMERCIAL_10065
        ));

        $this->assertEquals('Carta Registrada 10014', Servico::nomeCompleto(
            Servico::CARTA_REGISTRADA_10014
        ));

        $this->assertEquals('Carta Comercial Registrada 10707', Servico::nomeCompleto(
            Servico::CARTA_COMERCIAL_REGISTRADA_10707
        ));

        $this->assertEquals('PAC Contrato Agência 04669', Servico::nomeCompleto(
            Servico::PAC_CONTRATO_AGENCIA_04669
        ));

        $this->assertEquals('Sedex Contrato Agência 04162', Servico::nomeCompleto(
            Servico::SEDEX_CONTRATO_AGENCIA_04162
        ));

        $this->assertEquals('PAC 41106', Servico::nomeCompleto(
            Servico::PAC_41106
        ));

        $this->assertEquals('PAC 04596', Servico::nomeCompleto(
            Servico::PAC_04596
        ));

        $this->assertEquals('SEDEX 04553', Servico::nomeCompleto(
            Servico::SEDEX_04553
        ));

        $this->assertEquals('PAC 03085', Servico::nomeCompleto(
            Servico::PAC_03085
        ));

        $this->assertEquals('SEDEX 03050', Servico::nomeCompleto(
            Servico::SEDEX_03050
        ));
    }

    public function test_Retornar_Nome_Completo_Nulo_Se_Codigo_Nao_Existir()
    {
        $this->assertNull(Servico::nomeCompleto(
            000
        ));
    }

    public function test_Retornar_Nome_Dos_Servicos()
    {
        $this->assertEquals('PAC', Servico::nome(
            Servico::PAC_41068
        ));

        $this->assertEquals('PAC', Servico::nome(
            Servico::PAC_04510
        ));

        $this->assertEquals('PAC', Servico::nome(
            Servico::PAC_41300
        ));

        $this->assertEquals('E-Sedex', Servico::nome(
            Servico::ESEDEX_81019
        ));

        $this->assertEquals('Sedex', Servico::nome(
            Servico::SEDEX_40096
        ));

        $this->assertEquals('Sedex', Servico::nome(
            Servico::SEDEX_40436
        ));

        $this->assertEquals('Sedex', Servico::nome(
            Servico::SEDEX_40444
        ));

        $this->assertEquals('Sedex 12', Servico::nome(
            Servico::SEDEX_40169
        ));

        $this->assertEquals('Sedex 10', Servico::nome(
            Servico::SEDEX_40215
        ));

        $this->assertEquals('Sedex', Servico::nome(
            Servico::SEDEX_04014
        ));

        $this->assertEquals('Sedex 10', Servico::nome(
            Servico::SEDEX10_40886
        ));

        $this->assertEquals('Sedex Hoje', Servico::nome(
            Servico::SEDEX_HOJE_40290
        ));

        $this->assertEquals('Sedex Hoje', Servico::nome(
            Servico::SEDEX_HOJE_40878
        ));

        $this->assertEquals('Sedex', Servico::nome(
            Servico::SEDEX_VAREJO_A_COBRAR_40045
        ));

        $this->assertEquals('Sedex', Servico::nome(
            Servico::SEDEX_AGRUPADO_41009
        ));

        $this->assertEquals('Sedex', Servico::nome(
            Servico::SEDEX_REVERSO_40380
        ));

        $this->assertEquals('Sedex', Servico::nome(
            Servico::SEDEX_PAGAMENTO_NA_ENTREGA_40630
        ));

        $this->assertEquals('Carta Comercial', Servico::nome(
            Servico::CARTA_COMERCIAL_10065
        ));

        $this->assertEquals('Carta Registrada', Servico::nome(
            Servico::CARTA_REGISTRADA_10014
        ));

        $this->assertEquals('Carta Comercial', Servico::nome(
            Servico::CARTA_COMERCIAL_REGISTRADA_10707
        ));

        $this->assertEquals('PAC', Servico::nome(
            Servico::PAC_CONTRATO_AGENCIA_04669
        ));

        $this->assertEquals('Sedex', Servico::nome(
            Servico::SEDEX_CONTRATO_AGENCIA_04162
        ));

        $this->assertEquals('PAC', Servico::nome(
            Servico::PAC_41106
        ));

        $this->assertEquals('PAC', Servico::nome(
            Servico::PAC_04596
        ));

        $this->assertEquals('Sedex', Servico::nome(
            Servico::SEDEX_04553
        ));

        $this->assertEquals('PAC', Servico::nome(
            Servico::PAC_03085
        ));

        $this->assertEquals('Sedex', Servico::nome(
            Servico::SEDEX_03050
        ));
    }

    public function test_Retornar_Nome_Nulo_Se_Codigo_Nao_Existir()
    {
        $this->assertNull(Servico::nome(
            000
        ));
    }
}
