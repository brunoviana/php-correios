<?php

namespace BrunoViana\Correios\CalculoPrecoPrazo;

class Servico
{
    const PAC_41068 = "41068";
    const PAC_04510 = "04510";
    const PAC_41300 = "41300";
    const PAC_41106 = "41106";
    const PAC_CONTRATO_AGENCIA_04669 = "04669";

    const SEDEX_40096 = "40096";
    const SEDEX_40436 = "40436";
    const SEDEX_40444 = "40444";
    const SEDEX_40169 = "40169";
    const SEDEX_40215 = "40215";
    const SEDEX_04014 = "04014";
    const SEDEX_CONTRATO_AGENCIA_04162 = "04162";
    const SEDEX10_40886 = "40886";
    const SEDEX_HOJE_40290 = "40290";
    const SEDEX_HOJE_40878 = "40878";
    const SEDEX_VAREJO_A_COBRAR_40045 = "40045";
    const SEDEX_AGRUPADO_41009 = "41009";
    const SEDEX_REVERSO_40380 = "40380";
    const SEDEX_PAGAMENTO_NA_ENTREGA_40630 = "40630";

    const ESEDEX_81019 = "81019";

    const CARTA_COMERCIAL_10065 = "10065";

    const CARTA_REGISTRADA_10014 = "10014";

    const CARTA_COMERCIAL_REGISTRADA_10707 = "10707";

    const NOMES_SERVICOS = [
        self::PAC_41068 => [
            "codigo" => self::PAC_41068,
            "nome_completo" => "PAC 41068",
            "nome" => "PAC"
        ],
        self::PAC_04510 => [
            "codigo" => self::PAC_04510,
            "nome_completo" => "PAC 04510",
            "nome" => "PAC"
        ],
        self::PAC_41300 => [
            "codigo" => self::PAC_41300,
            "nome_completo" => "PAC Grandes Formatos",
            "nome" => "PAC"
        ],
        self::ESEDEX_81019 => [
            "codigo" => self::ESEDEX_81019,
            "nome_completo" => "E-Sedex Standard",
            "nome" => "E-Sedex"
        ],
        self::SEDEX_40096 => [
            "codigo" => self::SEDEX_40096,
            "nome_completo" => "Sedex 40096",
            "nome" => "Sedex"
        ],
        self::SEDEX_40436 => [
            "codigo" => self::SEDEX_40436,
            "nome_completo" => "Sedex 40436",
            "nome" => "Sedex"
        ],
        self::SEDEX_40444 => [
            "codigo" => self::SEDEX_40444,
            "nome_completo" => "Sedex 40444",
            "nome" => "Sedex"
        ],
        self::SEDEX_40169 => [
            "codigo" => self::SEDEX_40169,
            "nome_completo" => "Sedex 12",
            "nome" => "Sedex 12"
        ],
        self::SEDEX_40215 => [
            "codigo" => self::SEDEX_40215,
            "nome_completo" => "Sedex 10",
            "nome" => "Sedex 10"
        ],
        self::SEDEX_04014 => [
            "codigo" => self::SEDEX_04014,
            "nome_completo" => "Sedex à vista",
            "nome" => "Sedex"
        ],
        self::SEDEX10_40886 => [
            "codigo" => self::SEDEX10_40886,
            "nome_completo" => "Sedex 10 Pacote",
            "nome" => "Sedex 10"
        ],
        self::SEDEX_HOJE_40290 => [
            "codigo" => self::SEDEX_HOJE_40290,
            "nome_completo" => "Sedex Hoje 40290",
            "nome" => "Sedex Hoje"
        ],
        self::SEDEX_HOJE_40878 => [
            "codigo" => self::SEDEX_HOJE_40878,
            "nome_completo" => "Sedex Hoje 40878",
            "nome" => "Sedex Hoje"
        ],
        self::SEDEX_VAREJO_A_COBRAR_40045 => [
            "codigo" => self::SEDEX_VAREJO_A_COBRAR_40045,
            "nome_completo" => "Sedex Varejo à Cobrar",
            "nome" => "Sedex"
        ],
        self::SEDEX_AGRUPADO_41009 => [
            "codigo" => self::SEDEX_AGRUPADO_41009,
            "nome_completo" => "Sedex Agrupado",
            "nome" => "Sedex"
        ],
        self::SEDEX_REVERSO_40380 => [
            "codigo" => self::SEDEX_REVERSO_40380,
            "nome_completo" => "Sedex Reverso",
            "nome" => "Sedex"
        ],
        self::SEDEX_PAGAMENTO_NA_ENTREGA_40630 => [ "codigo" => self::SEDEX_PAGAMENTO_NA_ENTREGA_40630, "nome_completo" => "Sedex Pagamento na Entrega", "nome" => "Sedex"
        ],
        self::CARTA_COMERCIAL_10065 => [
            "codigo" => self::CARTA_COMERCIAL_10065,
            "nome_completo" => "Carta Comercial a Faturar",
            "nome" => "Carta"
        ],
        self::CARTA_REGISTRADA_10014 => [
            "codigo" => self::CARTA_REGISTRADA_10014,
            "nome_completo" => "Carta Registrada",
            "nome" => "Carta"
        ],
        self::CARTA_COMERCIAL_REGISTRADA_10707 => [
            "codigo" => self::CARTA_COMERCIAL_REGISTRADA_10707,
            "nome_completo" => "Carta Comercial Registrada",
            "nome" => "Carta"
        ],
        self::PAC_CONTRATO_AGENCIA_04669 => [
            "codigo" => self::PAC_CONTRATO_AGENCIA_04669,
            "nome_completo" => "PAC Contrato Agência",
            "nome" => "PAC"
        ],
        self::SEDEX_CONTRATO_AGENCIA_04162 => [
            "codigo" => self::SEDEX_CONTRATO_AGENCIA_04162,
            "nome_completo" => "Sedex Contrato Agência",
            "nome" => "Sedex"
        ],
        self::PAC_41106 => [
            "codigo" => self::PAC_41106,
            "nome_completo" => "PAC 41106",
            "nome" => "PAC"
        ],
    ];

    public static function todos()
    {
        return [
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
        ];
    }

    public static function nomeCompleto($codigo)
    {
        if (isset(self::NOMES_SERVICOS[ $codigo ])) {
            return self::NOMES_SERVICOS[ $codigo ]['nome_completo'];
        }
    }

    public static function nome($codigo)
    {
        if (isset(self::NOMES_SERVICOS[ $codigo ])) {
            return self::NOMES_SERVICOS[ $codigo ]['nome'];
        }
    }
}
