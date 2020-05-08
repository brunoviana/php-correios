<?php

namespace BrunoViana\Correios\Tests\CalculoPrecoPrazo;

use BrunoViana\Correios\Tests\TestCase;
use BrunoViana\Correios\CalculoPrecoPrazo\Servico;

class ServicoTest extends TestCase
{
    public function test_Deve_Retornar_Todos_Os_Servicos()
    {
        $servicos = Servico::todos();

        $this->assertCount(22, $servicos);
        $this->assertEquals([
            Servico::PAC_41068,
            Servico::PAC_04510,
            Servico::PAC_41300,
            Servico::PAC_CONTRATO_AGENCIA_04669,
            Servico::SEDEX_40096,
            Servico::SEDEX_40436,
            Servico::SEDEX_40444,
            Servico::SEDEX_40169,
            Servico::SEDEX_40215,
            Servico::SEDEX_04014,
            Servico::SEDEX_CONTRATO_AGENCIA_04162,
            Servico::SEDEX10_40886,
            Servico::SEDEX_HOJE_40290,
            Servico::SEDEX_HOJE_40878,
            Servico::SEDEX_VAREJO_A_COBRAR_40045,
            Servico::SEDEX_AGRUPADO_41009,
            Servico::SEDEX_REVERSO_40380,
            Servico::SEDEX_PAGAMENTO_NA_ENTREGA_40630,
            Servico::ESEDEX_81019,
            Servico::CARTA_COMERCIAL_10065,
            Servico::CARTA_REGISTRADA_10014,
            Servico::CARTA_COMERCIAL_REGISTRADA_10707,
        ], $servicos);
    }

    public function test_Retornar_Nome_Completo_Dos_Servicos()
    {
        $this->assertEquals('PAC 41068', Servico::nomeCompleto(
            Servico::PAC_41068
        ));

        $this->assertEquals('PAC 04510', Servico::nomeCompleto(
            Servico::PAC_04510
        ));

        $this->assertEquals('PAC Grandes Formatos', Servico::nomeCompleto(
            Servico::PAC_41300
        ));

        $this->assertEquals('E-Sedex Standard', Servico::nomeCompleto(
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

        $this->assertEquals('Sedex 12', Servico::nomeCompleto(
            Servico::SEDEX_40169
        ));

        $this->assertEquals('Sedex 10', Servico::nomeCompleto(
            Servico::SEDEX_40215
        ));

        $this->assertEquals('Sedex à vista', Servico::nomeCompleto(
            Servico::SEDEX_04014
        ));

        $this->assertEquals('Sedex 10 Pacote', Servico::nomeCompleto(
            Servico::SEDEX10_40886
        ));

        $this->assertEquals('Sedex Hoje 40290', Servico::nomeCompleto(
            Servico::SEDEX_HOJE_40290
        ));

        $this->assertEquals('Sedex Hoje 40878', Servico::nomeCompleto(
            Servico::SEDEX_HOJE_40878
        ));

        $this->assertEquals('Sedex Varejo à Cobrar', Servico::nomeCompleto(
            Servico::SEDEX_VAREJO_A_COBRAR_40045
        ));

        $this->assertEquals('Sedex Agrupado', Servico::nomeCompleto(
            Servico::SEDEX_AGRUPADO_41009
        ));

        $this->assertEquals('Sedex Reverso', Servico::nomeCompleto(
            Servico::SEDEX_REVERSO_40380
        ));

        $this->assertEquals('Sedex Pagamento na Entrega', Servico::nomeCompleto(
            Servico::SEDEX_PAGAMENTO_NA_ENTREGA_40630
        ));

        $this->assertEquals('Carta Comercial a Faturar', Servico::nomeCompleto(
            Servico::CARTA_COMERCIAL_10065
        ));

        $this->assertEquals('Carta Registrada', Servico::nomeCompleto(
            Servico::CARTA_REGISTRADA_10014
        ));

        $this->assertEquals('Carta Comercial Registrada', Servico::nomeCompleto(
            Servico::CARTA_COMERCIAL_REGISTRADA_10707
        ));

        $this->assertEquals('PAC Contrato Agência', Servico::nomeCompleto(
            Servico::PAC_CONTRATO_AGENCIA_04669
        ));

        $this->assertEquals('Sedex Contrato Agência', Servico::nomeCompleto(
            Servico::SEDEX_CONTRATO_AGENCIA_04162
        ));

        $this->assertEquals('PAC 41106', Servico::nomeCompleto(
            Servico::PAC_41106
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

        $this->assertEquals('Carta', Servico::nome(
            Servico::CARTA_COMERCIAL_10065
        ));

        $this->assertEquals('Carta', Servico::nome(
            Servico::CARTA_REGISTRADA_10014
        ));

        $this->assertEquals('Carta', Servico::nome(
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
    }

    public function test_Retornar_Nome_Nulo_Se_Codigo_Nao_Existir()
    {
        $this->assertNull(Servico::nome(
            000
        ));
    }
}
